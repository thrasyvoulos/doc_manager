<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Specialties */

$this->title = Yii::t('app', 'Update Specialty');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialty'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->specialtiesid, 'url' => ['view', 'id' => $model->specialtiesid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="specialties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
