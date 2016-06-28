<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    { 
        //return $this->render('index');
        //var_dump(isset(Yii::$app->session['user']));exit;
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['crmlog/index']);
            //return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['crmlog/index']);
           // return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        return $this->actionLogin();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
  
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionCalendar()
    {
        return $this->render('calendar');
    }
    public function actionPrefectures($id)
    {
          $rows = \app\models\Prefecture::find()->where(['countryid' => $id])->all();
 
        echo "<option>-Choose a Category-</option>";
 
        if(count($rows)>0){
            foreach($rows as $row){
                echo "<option value='$row->prefectureid'>$row->prefecturename</option>";
            }
        }
        else{
            echo "<option>-Choose a Category-</option>";
        }
    }
    
    public function actionCities($id)
    {
          $rows = \app\models\City::find()->where(['prefectureid' => $id])->all();
 
        echo "<option>-Choose a Category-</option>";
 
        if(count($rows)>0){
            foreach($rows as $row){
                echo "<option value='$row->cityid'>$row->cityname</option>";
            }
        }
        else{
            echo "<option>-Choose a Category-</option>";
        }
    }
}
