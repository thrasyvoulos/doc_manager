<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accountrvperson */

$this->title = 'Create Accountrvperson';
$this->params['breadcrumbs'][] = ['label' => 'Accountrvpeople', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accountrvperson-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
