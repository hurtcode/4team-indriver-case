<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

interface DriverRepository
{
    public function byId(int $id): ?Driver;

    public function byPhone(string $phone): ?Driver;

    public function persist(Driver &$driver): void;
}