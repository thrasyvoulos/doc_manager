<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = Yii::t('app','Countries');
?>

<div class="country-index">

    <h1><?php echo Yii::t('app','Countries'); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /*?><?= Html::a('Create Country','icon'=>'plus', ['create'], ['class' => 'btn btn-success']) ?><?php*/ ?>
    </p>
    <!-- Render create form -->    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
 <?php Pjax::begin(['id' => 'countries']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'countryid',
            'description',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end() ?>
    <?php /*?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'countryid',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
   <?php*/ ?>
</div>
<script>
/*function autoRefresh()
{
   window.location.reload();
}

setInterval('autoRefresh()', 5000); */// this will reload page after every 1 minute.
</script>
 
