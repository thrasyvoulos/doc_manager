<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if(Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN){?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->accountid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->accountid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php }?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'accountid',
            'firstname',
            'lastname',
            'username',
            'password',
            'email:email',
            [   
                'attribute'=>'active',
                'visible'=>Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            [   
                'attribute'=>'roleid',
                'visible'=>Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
           // 'active',
            //'roleid',
        ],
    ]) ?>

</div>
