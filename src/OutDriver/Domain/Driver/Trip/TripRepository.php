<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Trip;

interface TripRepository
{
	public function save(Trip $trip): void;

	public function getForMonth(int $driverId): array;

	public function getAllBySpec(string $driverPhone, int $offset, int $limit);
}