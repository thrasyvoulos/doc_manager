<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cityname')->textInput(['maxlength' => true]) ?>
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
<?php
//$test=  \app\models\Prefecture::
    //$items = ArrayHelper::map(\app\models\Prefecture::find()->all(), 'prefectureid', 'prefecturename');
  ?>  
   <?= $form->field($model, 'prefectureid')->dropDownList(['prompt'=>'-Choose a Category-']) ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
