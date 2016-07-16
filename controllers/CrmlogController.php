<?php

namespace app\controllers;

use app\models\Role;
use Yii;
use app\models\Crmlog;
use app\models\CrmlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * CrmlogController implements the CRUD actions for Crmlog model.
 */
class CrmlogController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Crmlog models.
     * @return mixed
     */
    public function actionCheck(){
        
        $query=  Crmlog::find()->where(['accountid' => Yii::$app->user->identity->accountid])
                ->orderBy(['crmlogid' => SORT_DESC])->one();
        $max2=$query->crmlogid;
        echo json_encode($max2);
    }
    public function actionEvents(){
        if(Yii::$app->user->identity->roleid==app\models\Role::ROLE_USER){
            $test = app\models\Crmlog::find()->where(['accountid' => Yii::$app->user->identity->accountid])->all();
        }else {
            $test = app\models\Crmlog::find()->all();
        }


        $events = array();
       //Testing

       foreach($test as $t){
             $Event = new \yii2fullcalendar\models\Event();
          // var_dump($t->crmlogid);exit;
       $Event->id = $t->crmlogid;
       if($t->status==0){
            $Event->backgroundColor='blue';
       }else {
            $Event->backgroundColor='green';

       }
       $Event->title = $t->rvperson->lastname.' '.$t->description;
       $Event->start = $t->fromdate;
              // $Event->end = $t->todate;
       //$Event->end=date('Y-m-d H:i:s');
       $events[] = $Event;

       }
       echo json_encode($events);
    }
    public function actionIndex()
    {
        $searchModel = new CrmlogSearch();
        if(Yii::$app->user->identity->roleid==Role::ROLE_ADMIN){
            $searchModel->accountid='-';
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Crmlog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Crmlog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Crmlog();
        $model->scenario = 'create';
        $model->crmtypeid=  Crmlog::CRMTYPE_RENDEZVOUS;
        $model->rvpersonid=$id;
        $model->createddate=date('Y-m-d H:i:s');
       // $model->fromdate=date('Y-m-d H:i:s');
       // $model->todate=date('Y-m-d H:i:s',strtotime('+1 hour'));
        $model->accountid=Yii::$app->user->identity->accountid;
        $model->status=0;
        //$model->save();
         //var_dump($model->getErrors());

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           if($model->save()){return $this->redirect(['index']);}


        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCreatelog($date){
        $model=new Crmlog();
       // $model->createddate=date('Y-m-d H:i:s');
       // var_dump($model->createddate);exit;
        
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        
    }
public function actionChange(){
   if (Yii::$app->request->isAjax) {
     
       $data = Yii::$app->request->post();

       $ex=  explode(',',$data['id']);

       $crmlogid=$ex[0];
       $status=$ex[1];
       $model = $this->findModel($crmlogid);
       $model->status=$status;
       $model->save();
      // var_dump($model->getErrors());exit;
    
    }
}


public function actionAppointment($id){
      
        $model = new Crmlog();
       // $model->scenario = 'create';
        $model->crmtypeid=  Crmlog::CRMTYPE_INTERNET;
        $model->createddate=date('Y-m-d H:i:s');
        $model->accountid=$id;
        $model->status=0;
      
        $model2=new \app\models\Rvperson();
        $model2->createddate=date('Y-m-d H:i:s');
        $model2->sex=1;
        if ($model2->load(Yii::$app->request->post()) && $model2->validate()) {
           
           if($model2->save())
               {
               //var_dump($model2->getErrors());exit;
                    $accountrvperson=new \app\models\Accountrvperson();
                    $accountrvperson->rvpersonid=$model2->rvpersonid;
                    $accountrvperson->accountid=$id;
                    $accountrvperson->createddate=date('Y-m-d H:i:s');
                    $accountrvperson->save();


                    $model->rvpersonid=$model2->rvpersonid;
                    $model->fromdate=$_POST['Crmlog']['fromdate'];
                   // $model->todate=$_POST['Crmlog']['todate'];
                    $model->description=$_POST['Crmlog']['description'];
                    //$model->save();
                    if($model->save()){
                        return $this->actionPrint($model, $id, $model2);
                     
                         //return $this->redirect(['/profile/search']);
                    }
                
               }
        

        } else {
            return $this->render('appointment', [
                'model' => $model,
                'model2'=>$model2,
                'id'=>$id
            ]);
        }
        
}

public function actionPrint($model, $id, $model2){
    
    //$model, $id, $model2
            $htmlContent=$this->renderPartial('print', ['model'=>$model,
                                                        'id'=>$id,
                                                        'model2'=>$model2]
                    );
               $pdf = new Pdf([
                    'mode' => Pdf::FORMAT_LETTER, // leaner size using standard fonts
                    'content' =>$htmlContent,
                    'destination' => Pdf::DEST_DOWNLOAD, 
                    'orientation' => Pdf::ORIENT_LANDSCAPE,
                    'options' => [
                        'title' => 'Doctor Appoinment',
                       // 'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'methods' => [
                        'SetHeader' => [date("d/m/Y H:i:s")],
                        'SetFooter' => ['|Page {PAGENO}|'],
                    ]
                ]);
               return $pdf->render(); // call mpdf write html
               
}
    /**
     * Updates an existing Crmlog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->crmlogid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Crmlog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Crmlog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Crmlog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Crmlog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
