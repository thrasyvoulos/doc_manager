<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //var_dump(Yii::$app->user->identity->roleid);exit;// echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN){?>
        <?= Html::a('Create Account', ['create'], ['class' => 'btn btn-success']) ?>
        <?php }?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'accountid',
            'firstname',
            'lastname',
            'username',
            'password',
            // 'email:email',
            // 'active',
            // 'roleid',

            ['class' => 'yii\grid\ActionColumn',
                 'visibleButtons' => [
                'delete' => function ($model, $key, $index) {
                    return $model->roleid === app\models\Role::ROLE_USER ? false : true;
                }
    ]
                ],
        ],
    ]); ?>
</div>
