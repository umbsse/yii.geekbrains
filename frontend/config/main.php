<?php
use yii\helpers\Url;
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:(logout|login|signup|feed)>' => 'user/<action>',
                'profile/<id:\d+>' => 'user/profile',
                'add' => '/tweet/add-tweet',
                'index' => 'tweet/index',
                'tweet/<id:\d+>'=> 'tweet/one',
                //'static/<act:\w+>'=>'StaticPages/default/<act:>',
                '<static:[\a-z0-9_-]+>' => Url::to('StaticPages/default/index'),
            ],
        ],

    ],
    'modules' => [
        'StaticPages' => [
            'class' => 'app\modules\StaticPages\StaticPagesModule',
        ],
    ],
    'params' => $params,
    'defaultRoute' => 'tweet/index'
];
