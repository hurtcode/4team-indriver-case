<?php

declare(strict_types=1);

namespace OutDriver\Yii\Db;

use Cycle\Database\DatabaseManager;
use Cycle\ORM\Factory;
use Cycle\ORM\ORM;
use Cycle\ORM\Schema;

final class OrmFactory
{
    public function __construct(
        private DatabaseManager $dbal,
        private Schema $schema,
    ) {
    }

    public function __invoke(): ORM
    {
        return new ORM(
            new Factory($this->dbal),
            $this->schema
        );
    }
}