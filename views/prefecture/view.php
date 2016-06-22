<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prefecture */

$this->title = $model->prefectureid;
$this->params['breadcrumbs'][] = ['label' => 'Prefectures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prefecture-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->prefectureid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->prefectureid], [
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
            'prefectureid',
            'prefecturename',
            'countryid',
        ],
    ]) ?>

</div>
