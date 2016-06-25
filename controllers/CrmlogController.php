<?php

namespace app\controllers;

use Yii;
use app\models\Crmlog;
use app\models\CrmlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
    public function actionIndex()
    { Yii::$app->getSession()->setFlash('success', 'Your Text Here..');

        $searchModel = new CrmlogSearch();
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
