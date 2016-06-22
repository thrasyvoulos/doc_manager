<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Crmlog */

$this->title = 'Update Crmlog: ' . $model->crmlogid;
$this->params['breadcrumbs'][] = ['label' => 'Crmlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->crmlogid, 'url' => ['view', 'id' => $model->crmlogid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="crmlog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
