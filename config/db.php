<?php

use yii\db\Connection;

return [
    'dbal' => new \Cycle\Database\DatabaseManager(
        new \Cycle\Database\Config\DatabaseConfig([
            'default' => 'default',
            'databases' => [
                'default' => ['connection' => 'pgsql']
            ],
            'connections' => [
                'pgsql' => new \Cycle\Database\Config\PostgresDriverConfig(
                    new \Cycle\Database\Config\Postgres\TcpConnectionConfig(
                        database: $_ENV['DB_NAME'],
                        host: $_ENV['DB_HOST'],
                        port: $_ENV['DB_PORT'],
                        user: $_ENV['DB_USER'],
                        password: $_ENV['DB_PASSWORD']
                    )
                )
            ],
        ])
    ),
];