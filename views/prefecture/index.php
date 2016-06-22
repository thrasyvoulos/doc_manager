<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrefectureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prefectures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prefecture-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prefecture', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'prefectureid',
            'prefecturename',
            //'countryid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
