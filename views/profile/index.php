<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        $query = \app\models\Profile::find()
            ->where(['accountid' => Yii::$app->user->identity->accountid])->one();
        $count=count($query);
        ?>
        <?php if($count<1 && Yii::$app->user->identity->roleid!=\app\models\Role::ROLE_ADMIN)  {?>
        <?= Html::a(Yii::t('app', 'Create Profile'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php }?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'profileid',
            //'accountid',
            'specialties.description',
            'firstname',
            'lastname',
            [
              'attribute'=>'city.cityname',
                'header'=>Yii::t('app','City')
            ],
             //'city.cityname',
             'address',
            // 'zipcode',
            // 'birthdate',
            // 'birthplace',
            // 'sex',
            // 'mobilephone',
            // 'telephone',
            // 'email:email',
            // 'gps',
            // 'createddate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
