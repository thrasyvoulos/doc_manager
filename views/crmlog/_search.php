<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CrmlogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crmlog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'crmlogid') ?>

    <?= $form->field($model, 'crmtypeid') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'accountid') ?>

    <?= $form->field($model, 'rvpersonid') ?>

    <?php // echo $form->field($model, 'createddate') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
