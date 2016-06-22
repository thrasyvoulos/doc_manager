<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accountrvperson */

$this->title = 'Update Accountrvperson: ' . $model->accountrvpersonid;
$this->params['breadcrumbs'][] = ['label' => 'Accountrvpeople', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->accountrvpersonid, 'url' => ['view', 'id' => $model->accountrvpersonid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accountrvperson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
