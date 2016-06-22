<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prefecture */

$this->title = 'Update Prefecture: ' . $model->prefectureid;
$this->params['breadcrumbs'][] = ['label' => 'Prefectures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prefectureid, 'url' => ['view', 'id' => $model->prefectureid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prefecture-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
