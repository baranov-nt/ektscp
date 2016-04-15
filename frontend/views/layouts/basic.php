<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\FontAwesome\AssetBundle;
use common\widgets\AlertIGrowl;
use yii\helpers\Url;
use common\widgets\FlagIconCss\FlagsAsset;

AppAsset::register($this);
AssetBundle::register($this);
FlagsAsset::register($this);
/* @var $user \common\models\Users */
$user = Yii::$app->user->identity;
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
<body style="">
<?php
$this->beginBody();
if(Yii::$app->controller->module->id == 'terminals' && Yii::$app->controller->action->id == 'map') {
    $shadow = '';
    $this->registerCss("
.shadow-bottom {
            box-shadow: 0 5px 5px -5px rgba(0, 0, 0, 0.75);
            position: relative;
            z-index: 10;
        }
 ");
} else {
    $shadow = 'shadow-bottom';
    $this->registerCss("
.shadow-bottom {
            box-shadow: 0 5px 5px -5px rgba(0, 0, 0, 0.75);
        }
 ");
}
?>
<div class="wrap clearfix"><div class="header-wrapper">
        <?php
        NavBar::begin(
            [
                'options' => [
                    'class' => 'navbar navbar-default navbar-fixed-top '.$shadow,
                    'style' => 'display: block; border-radius: 0;',
                    'id' => 'main-menu'
                ],
                'renderInnerContainer' => false,
                'innerContainerOptions' => [
                    //'class' => 'container'
                ],
                'brandLabel' => 'MCM',
                'brandUrl' => [
                    '/info/default/index'
                ],
                'brandOptions' => [
                    'class' => 'navbar-brand',
                    'style' => 'padding-top: 20px; margin-bottom: 10px; font-weight: 900; font-size: 32px; font-style: italic;'
                ]
            ]
        );

        $menuItems = [
            [//'label' => '<div class="hidden-xs" style="display: block; width: 90px; float: left;">&nbsp;</div><span class="navbar-main-items-size-1">'.Yii::t('app', 'КАРТА').'</span>', 'url' => ['/terminals/default/map'],
			'label' => '<span class="navbar-main-items-size-1">'.Yii::t('app', 'КАРТА').'</span>',
			'items' => [
                    ['label' => Yii::t('app', 'Городские смартфоны'), 'url' => Url::to(['/terminals/map'])],
                    ['label' => Yii::t('app', 'Интерактивные терминалы'), 'url' => Url::to(['/terminals/map/2'])],
                    ['label' => Yii::t('app', 'Мультимедийные экраны'), 'url' => Url::to(['/terminals/map/1'])],
                ],
                'linkOptions' => [
                    //'class' => 'navbar-main-items-left',
                    'style' => 'padding: 20px 10px 10px 10px'
                ]
                ],
            ['label' => '<span class="navbar-main-items-size-2">'.Yii::t('app', 'СЕРВИСЫ').'</span>',
                'items' => [
                    ['label' => Yii::t('app', 'SMART SHOP'), 'url' => Url::to(['/info/default/smart-shop'])],
                    ['label' => Yii::t('app', 'SMART SOFT'), 'url' => Url::to(['/info/default/smart-soft'])],
                    ['label' => Yii::t('app', 'SMART DESIGN'), 'url' => Url::to(['/info/default/smart-design'])],
                    ['label' => Yii::t('app', 'SMART MOBILE'), 'url' => Url::to(['/info/default/smart-mobile'])],
                ],
                'linkOptions' => [
                    //'class' => 'navbar-main-items-left',
                    'style' => 'padding: 20px 10px 10px 10px'
                ]
                ],
            [
                'label' => '<span class="navbar-main-items-size-3">'.Yii::t('app', 'ПАРТНЕРАМ').'</span>',
                'items' => [
                    //'<li class="dropdown-header">'.Yii::t('app', 'Authorization').'</li>',
                    //'<li class="divider"></li>',
                    ['label' => Yii::t('app', 'Предпринимателям'), 'url' => Url::to(['/info/business'])],
                    ['label' => Yii::t('app', 'Управляющим компаниям'), 'url' => Url::to(['/info/company'])],
                    ['label' => Yii::t('app', 'Органам власти'), 'url' => Url::to(['/info/authorities'])],
                    //['label' => Yii::t('app', 'Владельцам экранов и терминалов'), 'url' => Url::to(['/info/default/terminal-owners'])],
                    ['label' => Yii::t('app', 'Рекламным агентствам'), 'url' => Url::to(['/info/default/advertising-agencies'])],
                    ['label' => Yii::t('app', 'Дилерам'), 'url' => Url::to(['/info/default/dealers'])],
                    //['label' => Yii::t('app', 'Разработчикам'), 'url' => Url::to(['/info/default/developers'])],
                    ['label' => Yii::t('app', 'Производителям экранов и терминалов'), 'url' => Url::to(['/info/default/terminal-makers'])],
                ],
                'linkOptions' => [
                    //'class' => 'navbar-main-items-left',
                    'style' => 'padding: 20px 10px 10px 10px'
                ]
            ],
            [
                'label' => '<span class="navbar-main-items-size-4">'.Yii::t('app', 'КОНТАКТЫ').'</span>',
                'url' => ['/info/default/contacts'],
                'linkOptions' => [
                    //'class' => 'navbar-main-items-left',
                    'style' => 'padding: 20px 10px 10px 10px'
                ]
            ],
        ];

        if(Yii::$app->user->isGuest) {
            $menuItems[] = [
                'label' => '<span class="navbar-main-items-size-4">'.Yii::t('app', 'РЕГИСТРАЦИЯ').'</span>',
                'url' => Url::to(['/site/signup']),
                'linkOptions' => [
                    //'class' => 'navbar-main-items-left',
                    'style' => 'padding: 20px 10px 10px 10px'
                ]
            ];
            $menuItems[] = [
                'label' => '<span class="navbar-main-items-size-4">'.Yii::t('app', 'ВОЙТИ').'</span>',
                'url' => Url::to(['/site/login']),
                'linkOptions' => [
                    //'class' => 'navbar-main-items-left',
                    'style' => 'padding: 20px 10px 10px 10px'
                ]
            ];
        } else {
            $menuItems[] =  [
                'label' => '<span class="navbar-main-items-size-3">'.$user->tPerson->name.' '.$user->tPerson->family.'</span>',
                'items' => [
                    ['label' => Yii::t('app', 'Мой профиль'), 'url' => Url::to(['/users/profile/index'])],
                    ['label' => Yii::t('app', 'Мой бизнес'), 'url' => Url::to(['/bussness/manage/index'])],
                    ['label' => Yii::t('app', 'Выйти'), 'url' => Url::to(['/site/logout'])],
                ],
                'linkOptions' => [
                    //'class' => 'navbar-main-items-left',
                    'style' => 'padding: 20px 10px 10px 10px'
                ]
            ];
        }

        echo Nav::widget([
            'items' => $menuItems,
            'activateParents' => false,
            'encodeLabels' => false,
            'options' => [
                'class' => 'navbar-nav',
                //'stype' => 'display: block !important; padding: 20px 0 0 0 !important;'
            ],
        ]);

        $menuItems = [
            [
                'label' => '<button class="btn btn-primary btn-primary-inside-md">SMART MEDIA</button>',
                'url' => ['/adv/add'],
                'linkOptions' => [
                    'style' => 'padding: 10px 5px 0 5px'
                ]],
            [
                'label' => '<button class="btn btn-primary btn-primary-inside-md">УМНЫЙ СПРАВОЧНИК</button>',
                'url' => Url::to(['/catalog/default/index']),
                'linkOptions' => [
                    'style' => 'padding: 10px 5px 0 5px'
                ]],
            [
                'label' => 'Язык<br><button class="btn btn-default" style="padding: 0; margin: 0"><h3 style="margin: 0; padding: 0;"><span class="flag-icon flag-icon-ru flag-icon-squared" style="padding: 0; margin: 0"></span></h3></button>',
                'items' => [
                    //'<li class="dropdown-header">'.Yii::t('app', 'Authorization').'</li>',
                    //'<li class="divider"></li>',
                    ['label' => '<span class="flag-icon flag-icon-ru flag-icon-squared"></span> '.Yii::t('app', 'Русский'), 'url' => Url::to(['/#'])],
                    ['label' => '<span class="flag-icon flag-icon-gb flag-icon-squared"></span> '.Yii::t('app', 'Английский'), 'url' => Url::to(['/#'])],
                ],
                'linkOptions' => [
                    'class' => 'lang-buttom-navbar',
                    'style' => 'margin: 0 10px 0 0;'
                ],
            ],
        ];

        echo Nav::widget([
            'items' => $menuItems,
            'activateParents' => false,
            'encodeLabels' => false,
            'options' => [
                'class' => 'navbar-nav navbar-right',
                //stype' => 'display: block !important; padding: 20px 0 0 0 !important;'
            ],
        ]);

        NavBar::end();
        ?>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
	</div>

<div class="wrap-inner">
    <?= $content ?>
    <?= AlertIGrowl::widget() ?>
</div></div>

<footer class="footer footer-padding-scp">
        <div class="row" style="width: 100%">
            <div class="col-sm-4 text-center footer-padding-content-scp" style="padding-left: 20px !important;">&copy;<?= date('Y') ?> CITYSMARTMEDIA</div>
            <div class="col-sm-4 text-center ">&nbsp;

            </div>
            <div class="col-sm-4 text-center footer-padding-content-scp" style="padding-left: 20px !important;">Мы в соцсетях</div>
        </div>
</footer>

<?php $this->endBody() ?><div id="ajax-error-message" style="display: none"></div>
</body>
</html>
<?php $this->endPage() ?>