<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
	'id' => 'basic-console',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'controllerNamespace' => 'app\commands',
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
		'@tests' => '@app/tests',
	],
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'log' => [
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' => [
			'class' => \yii\db\Connection::class,
			'dsn' => (string)(new \OutDriver\Yii\Db\PostgresSqlDsn(
				$_ENV['DB_HOST'],
				$_ENV['DB_PORT'],
				$_ENV['DB_NAME'],
			)),
			'username' => $_ENV['DB_USER'],
			'password' => $_ENV['DB_PASSWORD'],
			'schemaMap' => [
				'pgsql' => [
					'class' => 'yii\db\pgsql\Schema',
					'defaultSchema' => $_ENV['DB_SCHEMA']
				]
			]
		],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
}

return $config;
