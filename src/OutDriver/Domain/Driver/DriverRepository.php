<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

interface DriverRepository
{
    public function byId(int $id): Driver;
}