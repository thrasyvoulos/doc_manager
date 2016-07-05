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
<?php

$this->registerJs(
    '$("document").ready(function(){ 
        $("#searchid").on("pjax:end", function() {
      
            $.pjax.reload({container:"#myid"});  //Reload GridView
        });
    });'
);
?>
    <?php 
    Pjax::begin(['id'=>'searchid']); ?>
<?php $form = ActiveForm::begin([
         'action' => ['search'],
         'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'lastname') ?>
     <?php
    //$test=  \app\models\Prefecture::
    $items2 = ArrayHelper::map(\app\models\Country::find()->all(), 'countryid', 'description');
    ?>
    <?=  $form->field($model, 'countryid')->dropDownList($items2,
        ['prompt'=>'-Choose a Category-',
            'onchange'=>'
                 $.get( "'.Yii::$app->urlManager->createUrl('/site/prefectures').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'prefectureid').'" ).html( data );
                            }
                        );
    ']);  ?>
    <?php  $items3 = ArrayHelper::map(\app\models\Prefecture::find()->all(), 'prefectureid', 'prefecturename'); ?>
    <?= $form->field($model, 'prefectureid')->dropDownList($items3,['prompt'=>'-Choose a Category-',
        'onchange'=>'
                 $.get( "'.Yii::$app->urlManager->createUrl('/site/cities').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'cityid').'" ).html( data );
                            }
                        );
            ']); ?>
    <?php  $items4= ArrayHelper::map(\app\models\City::find()->all(), 'cityid', 'cityname'); ?>
    <?= $form->field($model, 'cityid')->dropDownList($items4,['prompt'=>'-Choose a Category-']); ?>
    <?php
    $data=ArrayHelper::map(\app\models\Specialties::find()->orderBy(['description' => SORT_ASC])->all(), 'specialtiesid', 'description');

  
    $data=ArrayHelper::map(\app\models\Specialties::find()->orderBy(['description' => SORT_ASC])->all(), 'specialtiesid', 'description');
    //var_dump($data);exit;
    echo $form->field($model, 'specialtiesid')->widget(Select2::classname(), [
        'data' => $data,
        'options' => ['placeholder' => 'Select'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php //Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

<?php 

  
?>

<?php ActiveForm::end(); ?>
 <?php Pjax::end(); ?>

 