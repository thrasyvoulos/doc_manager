<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prefecture */

$this->title = Yii::t('app','Update Prefecture');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Prefectures'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->prefectureid];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="prefecture-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
