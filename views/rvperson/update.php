<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rvperson */

$this->title = Yii::t('app','Update Rvperson');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Contacts'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->rvpersonid, 'url' => ['view', 'id' => $model->rvpersonid]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="rvperson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
