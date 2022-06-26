<?php

declare(strict_types=1);

namespace OutDriver\Yii\Db;

final class PostgresSqlDsn implements \Stringable
{
    public function __construct(
        private string $host,
        private string $port,
        private string $user,
        private string $password,
        private string $db
    ) {
    }

    public function __toString(): string
    {
        return "postgresql://$this->user:$this->password@$this->host$this->port/$this->db";
    }
}