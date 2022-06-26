<?php

declare(strict_types=1);

namespace OutDriver\Infrastructure\Persistence\Driver;

use OutDriver\Domain\Driver\DriverRepository as DriverRepositoryInt;
use OutDriver\Infrastructure\Persistence\AbstractRepository;
use OutDriver\Domain\Driver\Driver;

final class DriverRepository extends AbstractRepository implements DriverRepositoryInt
{
    protected function entity(): string
    {
        return Driver::class;
    }

    public function byId(int $id): ?Driver
    {
        /** @var Driver $driver */
        try {
            $driver = $this->repository()->findByPK($id);
            return $driver;
        } catch (\Throwable $t) {
            throw new \RuntimeException($t->getMessage());
        }
    }

    public function byPhone(string $phone): ?Driver
    {
        /** @var Driver $driver */
        try {
            $driver = $this->repository()->findOne(['phone' => $phone]);
            return $driver;
        } catch (\Throwable $t) {
            throw new \RuntimeException($t->getMessage());
        }
    }

    public function persist(Driver &$driver): void
    {
        try {
            $this->transaction()->persist($driver)->run();
        } catch (\Throwable $t) {
            throw new \RuntimeException($t->getMessage());
        }
    }
}