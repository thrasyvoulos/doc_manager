<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use xj\bootbox\BootboxAsset;
BootboxAsset::register($this);
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Crmlog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crmlog-form">

    <?php 
    $form = ActiveForm::begin([
    'id' => 'crmlog-form',
    'type' => ActiveForm::TYPE_HORIZONTAL]); ?>
    <div class="panel panel-info">
        <div style="margin-top: 10px;margin-right: 10px;">
           
            <div class="panel-heading" >
                  <?php   $person = app\models\Profile::find()->where(['accountid' => $id])->one();
 ?>
                <h2><?= Html::img('@web/images/details.png');?><?php echo Yii::t('app', 'Στοιχεία');
                ?>
                 </h2>
                </div>
            <ul>

                <li> <?php echo Yii::t('app','First Name').': '.$person->firstname.'<br>' ?></li>
              <li>  <?php echo Yii::t('app','Last Name').': '.$person->lastname.'<br>' ?></li>
              <li>  <?php  echo Yii::t('app','Address').': '.$person->address.'<br>'?></li>
               <li> <?php  echo Yii::t('app','Specialty').': '.$person->specialties->description.'<br>'?> </li>
                
           </ul>
            
        </div>
        
     
    </div>
    <div class="panel panel-info">
        <div style="margin-top: 10px;margin-right: 10px">
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

   </div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Submit'), ['id'=>'test','class' =>'btn btn-success']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>
 
</div>

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  
</head>

<?php  $url =Url::to(['profile/search']);?>

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
        //var formData='';
       
     

    </script>
<?php

?>
</div>



<head>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIag5Rjp4335igKX52OTPVPcHARkzE6h0"
            async defer></script>

</head>

<script>
    var flag=false;
    $(document).ready(function () {
    $("#crmlog-form").on("beforeSubmit", function (event, messages) {
        flag=true;
        return true;
    });
});
 $('#test').on('click', function() {
    var s=  $('#crmlog-form').yiiActiveForm('validate');
   console.log(flag);
   console.log(s);
          var redirect = function(){
              if(flag==true){
                alert('Your appointment has been booked');
                window.location.replace('<?php echo $url; ?>');
     }
           
};
setTimeout(redirect, 4000);
        });

</script>