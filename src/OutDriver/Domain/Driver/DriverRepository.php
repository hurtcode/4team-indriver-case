<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

interface DriverRepository
{
	public function save(Driver $driver);

	public function byId(int $id): Driver;

	public function byPhone(string $phone): Driver;
}