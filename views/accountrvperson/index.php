<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountrvpersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accountrvpeople';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accountrvperson-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Accountrvperson', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'accountrvpersonid',
            'accountid',
            'rvpersonid',
            'createddate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
