<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rvperson */

$this->title = $model->lastname.' '.$model->firstname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rvperson-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

     <div class="panel panel-info">
        <div style="margin-top: 10px;margin-right: 10px">
            
                <h2><?= Html::img('@web/images/details.png');?><?php echo Yii::t('app', 'Στοιχεία');
                ?>
                 </h2>
               

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                       // 'rvpersonid',
                        'firstname',
                        'lastname',
                        'fathername',
                        'birthdate',
                        'birthplace',
                       /* [
                            'attribute'=>'sex',
                            'value'=>$model->getSex2(),
                        ],*/


                    ],
                ]) ?>


        </div>
    </div>
     <div class="panel panel-info">
        <div style="margin-top: 10px;margin-right: 10px">
           
                <h2> <?= Html::img('@web/images/address.png');?> <?php echo Yii::t('app', 'Address');
                ?>
               </h2>
           

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'rvpersonid',
                    [
                        'attribute'=>'cityid',
                        'value'=>$model->city->cityname,
                        'header'=>Yii::t('app','City')
                    ],
                    //'city.cityname',
                    'address',
                    'zipcode',
                    'birthdate',
                    'birthplace',


                ],
            ]) ?>


        </div>
    </div>
  <div class="panel panel-info">
         <div style="margin-top: 10px;margin-right: 10px">
            
                <h2><?= Html::img('@web/images/contact.png');?><?php echo Yii::t('app', 'Επικοινωνία');
                ?>
                

                </h2>
           

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'rvpersonid',
                    'mobilephone',
                    'telephone',
                    'email:email',
                    'gps',

                ],
            ]) ?>


        </div>
    </div>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rvpersonid',
            'firstname',
            'lastname',
            'fathername',
            'cityid',
            'address',
            'zipcode',
            'birthdate',
            'birthplace',
            'sex',
            'mobilephone',
            'telephone',
            'email:email',
            'gps',
            'createddate',
        ],
    ]) */?>

</div>
