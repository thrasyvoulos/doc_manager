<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Crmtype */

$this->title = $model->crmtypeid;
$this->params['breadcrumbs'][] = ['label' => 'Crmtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crmtype-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->crmtypeid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->crmtypeid], [
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
            'crmtypeid',
            'description',
        ],
    ]) ?>

</div>
