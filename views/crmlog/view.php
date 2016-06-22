<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Crmlog */

$this->title = $model->crmlogid;
$this->params['breadcrumbs'][] = ['label' => 'Crmlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crmlog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->crmlogid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->crmlogid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'crmlogid',
            'crmtypeid',
            'description:ntext',
            'accountid',
            'rvpersonid',
            'createddate',
            'status',
        ],
    ]) ?>

</div>
