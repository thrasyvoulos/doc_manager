<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Prefecture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prefecture-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prefecturename')->textInput(['maxlength' => true]) ?>

   <?php
//$test=  \app\models\Prefecture::
    $items = ArrayHelper::map(\app\models\Country::find()->all(), 'countryid', 'description');
  ?>  
   <?= $form->field($model, 'countryid')->dropDownList($items) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
