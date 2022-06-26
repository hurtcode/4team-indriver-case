<?php

declare(strict_types=1);

namespace OutDriver\Yii\Db;

final class PostgresSqlDsn implements \Stringable
{
	public function __construct(
		private string $host,
		private string $port,
		private string $db
	)
	{
	}

	public function __toString(): string
	{
		return "pgsql:host=$this->host;port=$this->port;dbname=$this->db";
	}
}