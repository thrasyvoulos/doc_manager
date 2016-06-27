<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CrmlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =Yii::t('app','Crmlogs');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="crmlog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
 
// echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
    </p>
    <?= GridView::widget([
        'id'=>'indexcrm',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid){
                if($model->status == 0){
                  return ['class' => 'warning'];
                }else{
                  return ['class' => 'success'];
                }
              },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'crmlogid',
            [
              'attribute'=>'crmtype.description',
              'header'=>'crmtype',
               'filter'=>Html::activeDropDownList($searchModel, 'crmtypeid', \yii\helpers\ArrayHelper::map(\app\models\Crmtype::find()->asArray()->all(),'crmtypeid','description'))
            ],
           // 'crmtype.description',
            'description:ntext',
            //'accountid',
            'rvperson.lastname',

            [
                'attribute'=>'fromdate',
                'value'=>'fromdate',
                'filter' => kartik\date\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'fromdate',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ],

                    'language' => 'en']),

            ],
            [
                'attribute'=>'todate',
                'value'=>'todate',
                'filter' => kartik\date\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'todate',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ],

                    'language' => 'en']),

            ],
            [
                'attribute'=>'accountid',
                'value'=>'account.username',
                'visible'=>Yii::$app->user->identity->roleid==\app\models\Role::ROLE_ADMIN,
                'filter'=>Html::activeDropDownList($searchModel, 'accountid',\yii\helpers\ArrayHelper::map(\app\models\Account::find()->asArray()->all(),'accountid','username'),[
                    'prompt' => '-',
                    // 'options' => ['840' => ['selected'=>'selected']]
                ])

            ],
           // 'fromdate',
           // 'todate',
            [
            'attribute' => 'status',
            'format' => 'raw',
           // 'filter'=>Html::activeDropDownList($searchModel, 'status', \yii\helpers\ArrayHelper::map(\app\models\Prefecture::find()->asArray()->all(),'prefectureid','prefecturename')),
            'filter'=>[ 0 => 'Δεν προσήλθε', 1 =>  'Προσήλθε'],
            'value' => function ($model, $index, $widget) {
                return Html::checkbox('status', $model->status, ['value' => $index,'id'=>$model->crmlogid ,'onchange'=>'js:clickedVal(this.id)']);
            },
],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
   /* 
    $test = app\models\Crmlog::find()->where(['accountid' => Yii::$app->user->identity->accountid])->all();

   $events = array();
  //Testing

  foreach($test as $t){
        $Event = new \yii2fullcalendar\models\Event();
     // var_dump($t->crmlogid);exit;
  $Event->id = $t->crmlogid;
  $Event->title = $t->rvperson->lastname;
  $Event->start = $t->createddate;
  $events[] = $Event;
  }
 <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
  )); 
 
 /* $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 2;
  $Event->title = 'Testing';
  $Event->start = date('Y-m-d\Th:m:s\Z',strtotime('tomorrow 6am'));
  $events[] = $Event;*/
 
  ?>
 
</div>

<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<script>
var checked;
 var concat;
function clickedVal(clicked_id){
   
    var c=document.getElementById(clicked_id);
if (c.checked) {
   checked=1;
  } else { 
   checked=0;
  }

 concat=clicked_id+','+checked;

  $.ajax({
        type: "POST",
        url: '<?php echo Yii::$app->urlManager->createUrl('crmlog/change'); ?>',
        data: {id : concat},
        success: function(arr){
            //on success reload gridview for change or row color to happen
           $("#indexcrm").yiiGridView("applyFilter");
         
         
        }
    });
}   
    
    
</script>