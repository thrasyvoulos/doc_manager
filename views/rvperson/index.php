<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RvpersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="rvperson-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app','Create Contact'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
     
    <?php
    
    echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
   'columns'=>[
            ['class' => '\kartik\grid\ExpandRowColumn',
            'value'=>  function($model, $key, $index, $column){
                return \kartik\grid\GridView::ROW_COLLAPSED;
            },
            'detail'=>function($model, $key, $index, $column){
                $searchModel=new app\models\CrmlogSearch();
                $searchModel->rvpersonid=$model->rvpersonid;
                $dataProvider=$searchModel->search(Yii::$app->request->queryParams);
                
                return Yii::$app->controller->renderPartial('_crmitems',[
                    'searchModel'=>$searchModel,
                    'dataProvider'=>$dataProvider
                ]);
            },
],
           // 'rvpersonid',
            'firstname',
            'lastname',
            'fathername',
            'city.cityname',
            'address',
       
            // 'zipcode',
            // 'birthdate',
            // 'birthplace',
            // 'sex',
            // 'mobilephone',
            // 'telephone',
            // 'email:email',
            // 'gps',
            // 'createddate',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{addlog}{map}',
                'buttons'=>[
                              'addlog' => function ($url, $model) {     
                                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                                        'title' => Yii::t('yii', 'Add log'),
                                ]);                                
            
                              },
                       'map' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-map-marker"></span>', $url, [
                            'title' => Yii::t('yii', 'Map'),
                        ]);

                    },
                                      
                                   ],
                'urlCreator' => function ($action, $model, $key, $index) {
        if ($action === 'addlog') {
            $url =Url::to(['crmlog/create', 'id' => $model->rvpersonid]); // your own url generation logic
            return $url;
                }
            else if($action==='view'){
                    $url = Url::to(['rvperson/view', 'id' => $model->rvpersonid]); // your own url generation logic
                    return $url; 
            }
            else if($action==='update'){
                    $url = Url::to(['rvperson/update', 'id' => $model->rvpersonid]); // your own url generation logic
                    return $url; 
            }
            else if($action==='delete'){
                    $url = Url::to(['rvperson/delete', 'id' => $model->rvpersonid]); // your own url generation logic
                    return $url; 
            } else if ($action === 'map') {
                        $url =Url::to(['rvperson/map', 'id' => $model->rvpersonid]); // your own url generation logic
                        return $url;
                    }
            
    }
                
                ],
        ],
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
   'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar'=> [
        ['content'=>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Rvperson', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
        ],
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export'=>[
        'fontAwesome'=>true
    ],
    // parameters from the demo form
   // 'bordered'=>$bordered,
   // 'striped'=>$striped,
    //'condensed'=>$condensed,
    //'responsive'=>$responsive,
   // 'hover'=>$hover,
    //'showPageSummary'=>$pageSummary,
    'panel'=>[
        'type'=>GridView::TYPE_ACTIVE,
       // 'heading'=>$heading,
    ],
    'persistResize'=>false,
   // 'exportConfig'=>$exportConfig,
]);
    ?>
    
  
</div>
