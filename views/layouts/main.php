<?php

/* @var $this \yii\web\View */
/* @var $content string */
use kartik\sidenav\SideNav;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
    
    <?php
    NavBar::begin([
        'brandLabel' => 'doc_manager',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-left',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            //['label' => 'Home', 'url' => ['/site/index']],
            
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Role', 'url' => ['/role/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => 'Country', 'url' => ['/country/index'],
               'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => 'Prefecture', 'url' => ['/prefecture/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => 'City', 'url' => ['/city/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => 'Crmtype', 'url' => ['/crmtype/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => 'Rvperson', 'url' => ['/rvperson/index'],
                'visible'=>!Yii::$app->user->isGuest
            ],
            ['label' => 'Crmlog', 'url' => ['/crmlog/index'],
                'visible'=>!Yii::$app->user->isGuest
            ],
            ['label' => 'Calendar', 'url' => ['/site/calendar'],
                'visible'=>!Yii::$app->user->isGuest
            ],
            /*['label' => 'Accountrvperson', 'url' => ['/accountrvperson/index'],
                //'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],*/
            ['label' => 'Account', 'url' => ['/account/index'],
                'visible'=>!Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
<?php

/*echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'items' => [
        [
            'url' => '#',
            'label' => 'Home',
            'icon' => 'home'
        ],
        [
            'label' => 'Help',
            'icon' => 'question-sign',
            'items' => [
                ['label' => 'About', 'icon'=>'info-sign', 'url'=>'#'],
                ['label' => 'Contact', 'icon'=>'phone', 'url'=>'#'],
            ],
        ],
    ],
]);*/
?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; doc_manager <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
