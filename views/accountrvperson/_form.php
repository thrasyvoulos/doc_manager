<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Accountrvperson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accountrvperson-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accountid')->textInput() ?>

    <?= $form->field($model, 'rvpersonid')->textInput() ?>

    <?= $form->field($model, 'createddate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
