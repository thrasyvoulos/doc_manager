<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
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
               <?php   $person = app\models\Profile::find()->where(['accountid' => $id])->one();
 ?>
               <?php echo 'Person information'.'<br>';?>
              
           </div>
       <div class="panel-body">
          
               <?php echo 'Fistname: '.$person->firstname.'<br>' ?>
                <?php echo 'Lastname: '.$person->lastname.'<br>' ?>
                <?php  echo 'Address: '.$person->address.'<br>'?>    

    </div>
  </div>
 <?= $form->field($model2, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model2, 'lastname')->textInput(['maxlength' => true]) ?>
    <?php  $items4= ArrayHelper::map(\app\models\City::find()->all(), 'cityid', 'cityname'); ?>
 
    
   <?= $form->field($model2, 'cityid')->widget(Select2::classname(), [
    'data' => $items4,
    'options' => ['placeholder' => 'Select'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
   ?>
<?= $form->field($model2, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model2, 'zipcode')->textInput(['maxlength' => true]) ?>
 <?= $form->field($model2, 'email')->textInput(['maxlength' => true]) ?>   
  <?= $form->field($model2, 'mobilephone')->textInput(['maxlength' => true]) ?>   
<?php

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

    echo $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
<?= $form->field($model2, 'gps')->hiddenInput(['maxlength' => true])->label(false); ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id'=>'submit','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<?php  //$url =Url::to(['profile/search']);?>
<head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
    <script>
        var address='';
        var zipcode='';
        var z= document.getElementById('rvperson-gps').value;
        //console.log(z);

        $('#rvperson-address').on('change', function() {

            address=this.value;

            //var map;

        });
        $('#rvperson-zipcode').on('change', function() {
            zipcode=this.value;
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode( { 'address': address+','+zipcode}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                    document.getElementById('rvperson-gps').value =latitude+','+longitude;
                    console.log(latitude);
                    console.log(longitude);
                }
            });
        });

    </script>
<?php

?>
</div>



<head>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIag5Rjp4335igKX52OTPVPcHARkzE6h0"
            async defer></script>

</head>

<script>


</script>