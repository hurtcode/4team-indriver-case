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
            'db' => [
                'class' => \yii\db\Connection::class,
                'dsn' => (string)(new \OutDriver\Yii\Db\PostgresSqlDsn(
                    $_ENV['DB_HOST'],
                    $_ENV['DB_PORT'],
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASSWORD'],
                    $_ENV['DB_NAME'],
                )),
                'schemaMap' => [
                    'pgsql' => [
                        'class' => 'yii\db\pgsql\Schema',
                        'defaultSchema' => $_ENV['DB_SCHEMA']
                    ]
                ]
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
