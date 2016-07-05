<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Crmlog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crmlog-form">

    <?php $form = ActiveForm::begin([
    'id' => 'crmlog-form',
    'type' => ActiveForm::TYPE_HORIZONTAL,
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'options'=>array(
            /* When false, the rules are run at the same time */
            /* When true at the same time than enableClientValidation,
                custom rules run after all the standard ones are cleared */
           // 'validateOnSubmit'=>false,
        ),
    ]); ?>
     <div class="panel panel-primary">
           <div class="panel-heading">
               <?php   $person = app\models\Rvperson::find()->where(['rvpersonid' => $model->rvpersonid])->one();
 ?>
               <?php echo 'Person information'.'<br>';?>
              
           </div>
       <div class="panel-body">
          
               <?php echo 'Fistname: '.$person->firstname.'<br>' ?>
                <?php echo 'Lastname: '.$person->lastname.'<br>' ?>
                <?php  echo 'Address: '.$person->address.'<br>'?>    

    </div>
  </div>

<?php

 /*echo $form->field($model, 'createddate')->widget(
    kartik\datetime\DateTimePicker::className(), [
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii:ss'
    ]
    // 'size' => 'sm',
    // 'clientOptions' => [
    //'format' => 'L LT',
    //  'stepping' => 30,
    //],
]);*/
echo $form->field($model, 'fromdate')->widget(
    kartik\datetime\DateTimePicker::className(), [
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii'
    ]
    // 'size' => 'sm',
    // 'clientOptions' => [
    //'format' => 'L LT',
    //  'stepping' => 30,
    //],
]);
/*echo $form->field($model, 'todate')->widget(
    kartik\datetime\DateTimePicker::className(), [
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii'
    ]
    // 'size' => 'sm',
    // 'clientOptions' => [
    //'format' => 'L LT',
    //  'stepping' => 30,
    //],
]);*/
$items3 = ArrayHelper::map(\app\models\Crmtype::find()->all(), 'crmtypeid', 'description'); ?>
     <?= $form->field($model, 'crmtypeid')->dropDownList($items3,['prompt'=>'-Choose a Category-',
     ]); ?>
   

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<script>
  /*  $(document).ready(function(event, jqXHR, settings){
        var form = $(this);
        if(form.find('.has-error').length) {
            return false;
        }
        $.ajax({
            url: form.attr('action'),
            url: '<?php// echo Yii::$app->urlManager->createUrl('crmlog/create'); ?>',
            data: {id : 2},
            success: function(data) {
              alert('hi');
            }
        });
return false;
    });*/
</script>