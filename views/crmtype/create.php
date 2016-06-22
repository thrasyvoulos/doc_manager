<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Crmtype */

$this->title = 'Create Crmtype';
$this->params['breadcrumbs'][] = ['label' => 'Crmtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crmtype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
