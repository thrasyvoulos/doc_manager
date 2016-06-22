<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rvperson */

$this->title = 'Create Rvperson';
$this->params['breadcrumbs'][] = ['label' => 'Rvpeople', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rvperson-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
