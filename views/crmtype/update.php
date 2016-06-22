<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Crmtype */

$this->title = 'Update Crmtype: ' . $model->crmtypeid;
$this->params['breadcrumbs'][] = ['label' => 'Crmtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->crmtypeid, 'url' => ['view', 'id' => $model->crmtypeid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="crmtype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
