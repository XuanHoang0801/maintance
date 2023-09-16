<?php
use yii\web\Request;
$baseUrl = str_replace('/frontend/web','',(new Request)->getBaseUrl());
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'vi', // tiếng việt
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\Customer',
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
                'dang-nhap' => 'site/login',
                'dang-ky' => 'site/signup',
                'doi-mat-khau' => 'site/change-password',
                'thong-tin' => 'customer/info',
                'nap-xu' =>'site/load-card',
                'lich-su-mua' => '/history/index',
                'tim-kiem' => '/site/search',

                'my-post/trang-<page:\d+>' => 'my-post/index',
                'my-post/<id:\d+>'=>'my-post/view',
                'my-post/<action:\w+>/<id:\d+>'=>'my-post/<action>',
                'my-post/' => 'my-post/index',


                'the-loai/<slug:\d+>'=>'category/slug',
                'the-loai/<action:\w+>/<slug:\d+>'=>'category/<action>',
                '/<slug>' => 'category/slug',

                'bai-viet/<id:\d+>' => 'post/index',
                [
                'pattern' =>'bai-viet/<slug>' ,
                'route'=> 'post/slug',
                'suffix'=>'.html'
                ],



                '<controller:\w+>/<action:\w+>/trang-<page:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],

        // 'urlManagerBackend' => [
        //     'class' => 'yii\web\urlManager',
        //     'baseUrl' => 'backend/web/uploads/',
        //     'enablePrettyUrl' => true,
        //     'showScriptName' => false,
        // ],
        // 'i18n' => [
        //     'translations' => [
        //         'app' => [
        //             'class' => 'yii\i18n\PhpMessageSource',
        //             // 'basePath' => '@app/messages',
        //             'sourceLanguage' => 'vi',
        //             'fileMap' => [
        //                 'app' => 'app.php',
        //                 'app/error' => 'error.php',
        //             ],
        //         ],
        //     ],
        // ],
    ],
    'params' => $params,
];
