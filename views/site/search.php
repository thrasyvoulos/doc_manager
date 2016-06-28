<?php




use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use kartik\widgets\Select2;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search';
$this->params['breadcrumbs'][] = $this->title;
?>
  <?php $form = ActiveForm::begin([
  	'id' => 'form-search',
  	'action' => ['search'],
    'method' => 'post',
    'type' => ActiveForm::TYPE_VERTICAL]); ?>

   

<div class="site-search">
    <h1><?= Html::encode($this->title) ?></h1>
<?php
    $data=ArrayHelper::map(\app\models\Specialties::find()->orderBy(['description' => SORT_ASC])->all(), 'specialtiesid', 'description');
    echo '<label class="control-label">Specialties</label>';
echo Select2::widget([
    'name' => 'state_10',
    'data' => $data,
    'options' => [
        'placeholder' => 'Select specialties ...',
        //'multiple' => true
    ],
]);
    ?>
    <br>
      <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
<?php 
 //$dataProvider=array();
/*$query = \app\models\Profile::find();

$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
*/
  echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'profileid',
            //'accountid',
            'specialties.description',
            'firstname',
            'lastname',
            [
              'attribute'=>'city.cityname',
                'header'=>Yii::t('app','City')
            ],
             //'city.cityname',
             'address',
            // 'zipcode',
            // 'birthdate',
            // 'birthplace',
            // 'sex',
            // 'mobilephone',
            // 'telephone',
            // 'email:email',
            // 'gps',
            // 'createddate',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{map}',
                'buttons'=>[
                    'map' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-map-marker"></span>', $url, [
                            'title' => Yii::t('yii', 'Map'),
                        ]);

                    },

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'map') {
                        $url =Url::to(['profile/map', 'id' => $model->profileid]); // your own url generation logic
                        return $url;
                    }
                    else if($action==='view'){
                        $url = Url::to(['profile/view', 'id' => $model->profileid]); // your own url generation logic
                        return $url;
                    }
                    else if($action==='update'){
                        $url = Url::to(['profile/update', 'id' => $model->profileid]); // your own url generation logic
                        return $url;
                    }
                    else if($action==='delete'){
                        $url = Url::to(['profile/delete', 'id' => $model->profileid]); // your own url generation logic
                        return $url;
                    }

                }

            ],
        ],
    ]);        

?>


</div>
<?php ActiveForm::end(); ?>