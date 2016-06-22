<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccountrvpersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accountrvperson-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'accountrvpersonid') ?>

    <?= $form->field($model, 'accountid') ?>

    <?= $form->field($model, 'rvpersonid') ?>

    <?= $form->field($model, 'createddate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
