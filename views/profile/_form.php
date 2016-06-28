<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
 div.required label.control-label:after {
    content: " *";
    color: red;
}   
</style>
<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>





    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fathersname')->textInput(['maxlength' => true]) ?>
    <?php
    $data=ArrayHelper::map(\app\models\Specialties::find()->orderBy(['description' => SORT_ASC])->all(), 'specialtiesid', 'description');
    //var_dump($data);exit;
    echo $form->field($model, 'specialtiesid')->widget(Select2::classname(), [
        'data' => $data,
        'options' => ['placeholder' => 'Select'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>
    <?php
    //$test=  \app\models\Prefecture::
    $items2 = ArrayHelper::map(\app\models\Country::find()->all(), 'countryid', 'description');
    ?>
    <?=  $form->field($model, 'countryid')->dropDownList($items2,
        ['prompt'=>'-Choose a Category-',
            'onchange'=>'
                 $.get( "'.Yii::$app->urlManager->createUrl('/site/prefectures').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'prefectureid').'" ).html( data );
                            }
                        );
    ']);  ?>
    <?php  $items3 = ArrayHelper::map(\app\models\Prefecture::find()->all(), 'prefectureid', 'prefecturename'); ?>
    <?= $form->field($model, 'prefectureid')->dropDownList($items3,['prompt'=>'-Choose a Category-',
        'onchange'=>'
                 $.get( "'.Yii::$app->urlManager->createUrl('/site/cities').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'cityid').'" ).html( data );
                            }
                        );
            ']); ?>
    <?php  $items4= ArrayHelper::map(\app\models\City::find()->all(), 'cityid', 'cityname'); ?>
    <?= $form->field($model, 'cityid')->dropDownList($items4,['prompt'=>'-Choose a Category-']); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthdate')->widget(
        kartik\date\DatePicker::className(), [
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
        // 'size' => 'sm',
        // 'clientOptions' => [
        //'format' => 'L LT',
        //  'stepping' => 30,
        //],
    ]);?>

    <?= $form->field($model, 'birthplace')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'sex')->widget(Select2::classname(), [
        'data' => $model->getSex(),
        'options' => ['placeholder' => 'Select'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>


    <?= $form->field($model, 'mobilephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'note')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
  
    <?= $form->field($model, 'gps')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<script>
    var address='';
    var zipcode='';
    var z= document.getElementById('profile-gps').value;
    //console.log(z);

    $('#profile-address').on('change', function() {

        address=this.value;

        //var map;

    });
    $('#profile-zipcode').on('change', function() {
        zipcode=this.value;
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': address+','+zipcode}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                document.getElementById('profile-gps').value =latitude+','+longitude;
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