<?php

declare(strict_types=1);

namespace OutDriver\Infrastructure\Driver;

use OutDriver\Domain\Driver\Driver;
use OutDriver\Infrastructure\Persistence\AbstractRepository;

final class DriverRepository
    extends AbstractRepository
    implements \OutDriver\Domain\Driver\DriverRepository

{
    protected function entity(): string
    {
        return Driver::class;
    }

    public function byId(int $id): Driver
    {
        /** @var Driver $driver */
        try {
            $driver = $this->repository()->findByPK($id);
            return $driver;
        } catch (\Throwable $t) {
        }
    }

    public function byPhone(string $phone): Driver
    {
        /** @var Driver $driver */
        try {
            $driver = $this->repository()->findOne(['phone' => $phone]);
            return $driver;
        } catch (\Throwable $t) {
        }
    }

    public function save(Driver $driver): void
    {
        try {
            $this->transaction()->persist($driver);
        } catch (\Throwable $t) {
        }
    }
}