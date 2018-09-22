<?php
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
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'ru',
    'modules' => [
        'api' => [
            'class' => 'frontend\modules\api\api',
        ],
    ],
    'components' => [
        'language' => 'ru',
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => ['application/json' => 'yii\web\JsonParser'],
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
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['security'],
                    'logFile' => '@runtime/logs/security.log',
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
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/user', 'api/project'],
                ],
                '<controller:[\w-]+>/<id:\d+>' => '<controller>/view',//контроллер теперь понимает путь task/123 и работает как с task/view?id=12
                '<controller>s' => '<controller>/index',//контроллер теперь понимает путь tasks и работает как с task/index
            ],
        ],
    ],
    'params' => $params,
];
