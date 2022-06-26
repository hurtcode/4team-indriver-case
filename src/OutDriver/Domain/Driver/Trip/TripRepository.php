<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Trip;

interface TripRepository
{
    public function persists(Trip &$trip): void;

    public function getForMonth(int $driverId): array;

    public function getAllBySpec(int $driverId, int $offset, int $limit);

    public function allTripsCount(int $driverId): int;
}