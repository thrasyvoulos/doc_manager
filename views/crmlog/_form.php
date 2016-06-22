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
    'id' => 'form-crmlog',
    'type' => ActiveForm::TYPE_HORIZONTAL
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

<?php  $items3 = ArrayHelper::map(\app\models\Crmtype::find()->all(), 'crmtypeid', 'description'); ?>
     <?= $form->field($model, 'crmtypeid')->dropDownList($items3,['prompt'=>'-Choose a Category-',
     ]); ?>
   

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'createddate')->widget(
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
]);?>
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
