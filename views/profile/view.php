<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->lastname.' '.$model->firstname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->profileid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->profileid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
 <div class="panel panel-info">
        <div style="margin-top: 10px;margin-right: 10px">
            <div class="panel-heading">
                <h2><?= Html::img('@web/images/details.png');?><?php echo Yii::t('app', 'Στοιχεία');
                ?>
                 </h2>
               
                </div>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                       // 'rvpersonid',
                        'firstname',
                        'lastname',
                        'specialties.description',
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
            <div class="panel-heading">
                <h2> <?= Html::img('@web/images/address.png');?> <?php echo Yii::t('app', 'Address');
                ?>
               </h2>
            </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                  
                    [
                        'attribute'=>'cityid',
                        'value'=>$model->city->cityname,
                        'header'=>Yii::t('app','City')
                    ],
              
                    'address',
                    'zipcode',
                    'birthdate',
                    'birthplace',
                    //'sex'

                ],
            ]) ?>


        </div>
    </div>
      <div class="panel panel-info">
         <div style="margin-top: 10px;margin-right: 10px">
            <div class="panel-heading">
                <h2><?= Html::img('@web/images/contact.png');?><?php echo Yii::t('app', 'Επικοινωνία');
                ?>
                

                </h2>
            </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                 
                    'mobilephone',
                    'telephone',
                    'email:email',
                    'gps',

                ],
            ]) ?>


        </div>
    </div>
    <div class="panel panel-info">
         <div style="margin-top: 10px;margin-right: 10px">
             <div class="panel-heading">
                  <h2><?php echo Yii::t('app', 'Logo');
                ?>
                

                </h2>
                 
             </div>
            <?= Html::img('@web/'.$model->logo);?>
               
                
         </div>
    </div>
    
</div>
