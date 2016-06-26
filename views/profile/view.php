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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'profileid',
            //'accountid',
            'firstname',
            'lastname',
            'specialties.description',
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
            'sex',
            'mobilephone',
            'telephone',
            'email:email',
            'gps',
            'createddate',
        ],
    ]) ?>

</div>
