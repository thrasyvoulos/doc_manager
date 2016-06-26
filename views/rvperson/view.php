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

    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->rvpersonid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->rvpersonid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="col-sm-4">
        <div class="panel panel-info" style="width:200px;">
            <div class="panel-heading">
                <?php echo Yii::t('app', 'Στοιχεία');
                ?>
                </div>

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
    <div class="col-sm-4">
        <div class="panel panel-info" style="width:200px;">
            <div class="panel-heading">
                <?php echo Yii::t('app', 'Address');
                ?>
            </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'rvpersonid',
                    'city.cityname',
                    'address',
                    'zipcode',
                    'birthdate',
                    'birthplace',


                ],
            ]) ?>


        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-info" style="width:200px;">
            <div class="panel-heading">
                <?php echo Yii::t('app', 'Επικοινωνία');
                ?>
            </div>

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
