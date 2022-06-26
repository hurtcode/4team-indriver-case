<?php

return call_user_func(static function () {
    $params = require __DIR__ . '/params.php';
    $db = require __DIR__ . '/db.php';

    $config = [
        'id' => 'basic',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'aliases' => [
            '@bower' => '@vendor/bower-asset',
            '@npm' => '@vendor/npm-asset',
        ],
        'language' => 'ru-RU',
        'controllerMap' => [
            'site' => \OutDriver\Yii\Application\SiteController::class,
            'trip' => \OutDriver\Yii\Application\Trip\TripController::class,
            'driver' => \OutDriver\Yii\Application\Driver\DriverController::class
        ],
        'container' => require __DIR__ . '/definitions.php',
        'components' => [
            'request' => [
                'cookieValidationKey' => 'PZxC-3KCOyZzMKqAoQXTrMUL9wR83hZF',
            ],
            'cache' => [
                'class' => 'yii\caching\FileCache',
            ],
            'user' => [
                'identityClass' => \OutDriver\Yii\Application\Driver\ApplicationUser::class,
                'enableAutoLogin' => true,
                'loginUrl' => ['driver/sign-in']
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
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
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                ],
            ],
        ],
        'params' => $params,
    ];

    if (YII_ENV_DEV) {
        // configuration adjustments for 'dev' environment
        $config['bootstrap'][] = 'debug';
        $config['modules']['debug'] = [
            'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
        ];

        $config['bootstrap'][] = 'gii';
        $config['modules']['gii'] = [
            'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
        ];
    }

    return $config;
});
