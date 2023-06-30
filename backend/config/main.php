<?php

use yii\web\Request;
$baseUrl = str_replace('/backend/web','/backend', (new Request)->getBaseUrl());

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'baseUrl'=> $baseUrl,
        ],

        'urlManager' => [
        'baseUrl'=> $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'the-loai/trang-<page:\d+>' => 'category/index',
                'the-loai/<id:\d+>'=>'category/view',
                'the-loai/<action:\w+>/<id:\d+>'=>'category/<action>',
                'the-loai/' => 'category/index',

                'bai-viet/trang-<page:\d+>' => 'post/index',
                'bai-viet/<id:\d+>'=>'post/view',
                'bai-viet/<action:\w+>/<id:\d+>'=>'post/<action>',
                'bai-viet/' => 'post/index',
                'bai-viet/<action:\w+>' => 'post/create',

                '<controller:\w+>/<action:\w+>/trang-<page:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],

        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    // 'basePath' => '@app/messages',
                    'sourceLanguage' => 'vi',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        
    ],
    'params' => $params,
];
