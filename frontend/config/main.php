<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$db = require(__DIR__ . '/db.php');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => '/info/default/index',
    'modules' => [
        'terminals' => [
            'class' => 'frontend\modules\terminals\Module',
        ],
        'info' => [
            'class' => 'frontend\modules\info\Module',
        ],
        'adv' => [
            'class' => 'frontend\modules\adv\Module',
        ],
        'catalog' => [
            'class' => 'frontend\modules\catalog\Module',
        ],        
		'tariff' => [
            'class' => 'frontend\modules\tariff\Module',
        ],
        'users' => [
            'class' => 'frontend\modules\users\Module',
        ],
        'bussness' => [
            'class' => 'frontend\modules\bussness\Module',
        ],
        'api' => [
            'class' => 'frontend\modules\api\Module',
        ],
		'gii' => [
            'class' => 'yii\gii\Module',
			'allowedIPs' => ['109.198.112.66', '127.0.0.1'],
        ],
    ],
    'components' => [
		'tariffing'=> [
			'class' => 'frontend\modules\tariff\components\Tariffing',
		],		
		'request' => [
			'enableCsrfValidation' => false,
		],
        'assetManager'=>[
            'class'=>'yii\web\AssetManager',
            'linkAssets'=>true,
        ],
        'user' => [
            'identityClass' => 'common\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' => ['/site/login'],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                [
                    'pattern' => '',
                    'route' => '/info/default/index',
                ],
                [
                    'pattern' => '/terminals/<action>',
                    'route' => '/terminals/default/<action>',
                ],
                [
                    'pattern' => '/terminals/<action>/<id:\d+>',
                    'route' => '/terminals/default/<action>',
                ],
                [
                    'pattern' => '/api/<action>',
                    'route' => '/api/default/<action>',
                ],
                [
                    'pattern' => '/api/<action>/<api_key:\S+>',
                    'route' => '/api/default/<action>',
                ],
                [
                    'pattern' => '/api/<action>/<api_key:\S+>/<id:\d+>',
                    'route' => '/api/default/<action>',
                ],
                [
                    'pattern' => 'info/<action>',
                    'route' => 'info/default/<action>',
                ],
                [
                    'pattern' => 'adv/<action>',
                    'route' => 'adv/default/<action>',
                ],
                [
                    'pattern' => 'catalog',
                    'route' => 'catalog/default/index',
                ],
                [
                    'pattern' => 'catalog/<action>',
                    'route' => 'catalog/default/<action>',
                ],
                [
                    'pattern' => 'adv/<action>',
                    'route' => 'adv/default/<action>',
                ],                
                [
                    'pattern' => '/tariff/<action>',
                    'route' => '/tariff/default/<action>',
                ],
                [
                    'pattern' => '/tariff/<action>/<type>',
                    'route' => '/tariff/default/<action>',
                ],				
                [
                    'pattern' => '<controller>/<action>/<id:\d+>',
                    'route' => '<controller>/<action>',
                ],
                [
                    'pattern' => '<controller>/<action>',
                    'route' => '<controller>/<action>',
                ],
                [
                    'pattern' => '<module>/<controller>/<action>/<id:\d+>',
                    'route' => '<module>/<controller>/<action>',
                ],
                [
                    'pattern' => '<module>/<controller>/<action>',
                    'route' => '<module>/<controller>/<action>',
                ],
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'db' => $db,
    ],
    'params' => $params,
];
