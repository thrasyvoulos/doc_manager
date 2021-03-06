<?php

namespace app\controllers;

use app\models\Account;
use app\models\City;
use app\models\Country;
use app\models\Prefecture;
use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
            /*'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','update','index','view','delete'],
                'rules' => [
                    // deny all POST requests
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'verbs' => ['POST']
                    ],
                    // allow authenticated users
                    [
                        /*'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],*/
            ];
        
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model=new Profile();
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }
    public function actionSearch()
    {   
        //$model=new Profile();
       // $model->countryid=1;
         $searchModel = new ProfileSearch();
        /* $model=new ProfileSearch();
        if ($searchModel->load(Yii::$app->request->post()))
        {
            $model = new ProfileSearch(); //reset model
        }*/
       
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('_search', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
           // 'model'=>$model
            ]); 
    }
    /**
     * Displays a single Profile model.
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
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $query = Account::find()->where(['accountid' => Yii::$app->user->identity->accountid])->one();
       
        $model = new Profile();
        
        $model->scenario='create';
        $model->firstname=$query->firstname;
        $model->lastname=$query->lastname;
        $model->email=$query->email;
        $model->accountid=Yii::$app->user->identity->accountid;
        $model->createddate=date('Y-m-d');

        if ($model->load(Yii::$app->request->post())) {
            $imagename=$model->accountid;
            $model->file=  \yii\web\UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('@web/images/'.$imagename.'.'.$model->file->extension);
            $model->logo='images/'.$imagename.'.'.$model->file->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->profileid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario='create';
        $city = City::find()
            ->where(['cityid' => $model->cityid])->one();
        $prefecture = Prefecture::find()
            ->where(['prefectureid' => $city->prefectureid])->one();
        $country = Country::find()
            ->where(['countryid' => $prefecture->countryid])->one();

        $model->prefectureid=$prefecture->prefectureid;
        $model->countryid=$country->countryid;
        if ($model->load(Yii::$app->request->post())) {
                $imagename=$model->accountid;
            $model->file=  \yii\web\UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('images/'.$imagename.'.'.$model->file->extension);
            $model->logo='images/'.$imagename.'.'.$model->file->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->profileid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionMap($id){
        $model = $this->findModel($id);
        return $this->render('map', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Profile model.
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
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
