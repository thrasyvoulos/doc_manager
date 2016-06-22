<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Crmlog */

$this->title = 'Create Crmlog';
$this->params['breadcrumbs'][] = ['label' => 'Crmlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crmlog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
