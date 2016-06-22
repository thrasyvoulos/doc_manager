<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rvperson */

$this->title = 'Update Rvperson: ' . $model->rvpersonid;
$this->params['breadcrumbs'][] = ['label' => 'Rvpeople', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rvpersonid, 'url' => ['view', 'id' => $model->rvpersonid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rvperson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
