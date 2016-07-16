<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Crmlog */
?>

<?php

$this->title = Yii::t('app', 'Update Crmlog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Crmlogs'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->crmlogid, 'url' => ['view', 'id' => $model->crmlogid]];
$this->params['breadcrumbs'][] =  Yii::t('app', 'Update');
?>
<div class="crmlog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
