<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use kartik\widgets\Select2;
use kartik\form\ActiveForm;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model app\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">
<?= $this->render('_searchform', [
        'model' => $model,
    ]) ?>
    <?php Pjax::begin(['id'=>'myid']); ?>
<?php 

  echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'profileid',
            //'accountid',
            'specialties.description',
            'firstname',
            'lastname',
            [
              'attribute'=>'city.cityname',
                'header'=>Yii::t('app','City')
            ],
             //'city.cityname',
             'address',
             [
                'attribute'=>'note',
                'format'=>'raw'
            ],
            // 'zipcode',
            // 'birthdate',
            // 'birthplace',
            // 'sex',
            'mobilephone',
            // 'telephone',
            'email:email',
            // 'gps',
            // 'createddate',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{map}{appointment}',
                'buttons'=>[
                    'map' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-map-marker"></span>', $url, [
                            'title' => Yii::t('yii', 'Map'),
                        ]);

                    },
                    'appointment' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                            'title' => Yii::t('yii', 'Appointment'),
                        ]);

                    },

                ],
                'visibleButtons' => [
                'update' => function ($model, $key, $index) {
                    return Yii::$app->user->isGuest ? false : true;
                },
                'delete' => function ($model, $key, $index) {
                    return Yii::$app->user->isGuest ? false : true;
                },
                 'view' => function ($model, $key, $index) {
                    return Yii::$app->user->isGuest ? false : true;
                }
            ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'map') {
                        $url =Url::to(['profile/map', 'id' => $model->profileid]); // your own url generation logic
                        return $url;
                    }
                    else if($action==='view'){
                        $url = Url::to(['profile/view', 'id' => $model->profileid]); // your own url generation logic
                        return $url;
                    }
                    else if($action==='update'){
                        $url = Url::to(['profile/update', 'id' => $model->profileid]); // your own url generation logic
                        return $url;
                    }
                    else if($action==='delete'){
                        $url = Url::to(['profile/delete', 'id' => $model->profileid]); // your own url generation logic
                        return $url;
                    }
                    else if($action==='appointment'){
                        $url = Url::to(['crmlog/appointment', 'id' => $model->accountid]); // your own url generation logic
                        return $url;
                    }

                }

            ],
        ],
    ]);        

?>
 <?php Pjax::end(); ?>

 
</div>
