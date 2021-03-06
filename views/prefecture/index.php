<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PrefectureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Prefectures');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$script = <<< JS
$(module).ready(function() {
    setInterval(function() {     
      $.pjax.reload({container:'#myid'});
    }, 5000); 
});
JS;
$this->registerJs($script);
?>
<div class="prefecture-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app','Create Prefecture'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['id'=>'myid']); ?>
    <?= GridView::widget([
        'id'=>'module',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'prefectureid',
            'prefecturename',
             'country.description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
