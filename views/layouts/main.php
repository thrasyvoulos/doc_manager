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
            
            /*['label' => 'Accountrvperson', 'url' => ['/accountrvperson/index'],
                //'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],*/
            ['label' => Yii::t('app','Account'), 'url' => ['/account/index'],
                'visible'=>!Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                     Yii::t('app','Logout').' '.'(' . Yii::$app->user->identity->username . ')',
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
?>
<div class="row">
        <div class="col-sm-2 bs-docs-sidebar">
            <div class="span3 bs-docs-sidebar">

                <?php
                $items=[
                   ['label' => 'Role','icon'=>'sunglasses', 'url' => ['/role/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => Yii::t('app','Countries'),'icon'=>'globe', 'url' => ['/country/index'],
               'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => Yii::t('app','Prefectures'), 'icon'=>'list-alt', 'url' => ['/prefecture/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => 'City', 'icon'=>'list', 'url' => ['/city/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => 'Crmtype', 'url' => ['/crmtype/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
            ['label' => Yii::t('app','Contacts'), 'icon'=>'user','url' => ['/rvperson/index'],
                'visible'=>!Yii::$app->user->isGuest
            ],
            ['label' => Yii::t('app','Specialties'),'icon'=>'list', 'url' => ['/specialties/index'],
                'visible'=>!Yii::$app->user->isGuest && Yii::$app->user->identity->roleid==app\models\Role::ROLE_ADMIN
            ],
                    ['label' => Yii::t('app','Crmlogs'), 'icon'=>'list-alt', 'url' => ['/crmlog/index'],
                'visible'=>!Yii::$app->user->isGuest
            ],
            ['label' => Yii::t('app','Calendar'),'icon'=>'calendar', 'url' => ['/site/calendar'],
                'visible'=>!Yii::$app->user->isGuest
            ],
            ['label' => Yii::t('app','Profile'),'icon'=>'user', 'url' => ['/profile/index'],
                        'visible'=>!Yii::$app->user->isGuest
            ],
                ];
                  echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'items' => $items
]);

                ?>
            </div>
        </div>
    <?php

?>
    <div class="col-sm-10" style="padding-left: 40px">
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
