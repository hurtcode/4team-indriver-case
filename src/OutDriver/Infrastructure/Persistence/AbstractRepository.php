<?php

declare(strict_types=1);

namespace OutDriver\Infrastructure\Persistence;

use Cycle\ORM\EntityManager;
use Cycle\ORM\ORM;
use Cycle\ORM\Select\Repository;

/**
 * @template TEntity
 */
abstract class AbstractRepository
{
    public function __construct(
        private ORM $orm
    ) {
    }

    /** @return class-string<TEntity> */
    protected abstract function entity(): string;

    /** @return Repository<TEntity> */
    protected function repository(): Repository
    {
        return $this->orm->getRepository($this->entity());
    }

    protected function transaction(): EntityManager
    {
        return new EntityManager($this->orm);
    }
}