<?php

declare(strict_types=1);

namespace OutDriver\Domain\TripHistory;

interface TripRepository
{
    public function getForMonth(): array;

    public function save(Trip $trip): void;

    public function getAllBySpec(string $driverPhone, int $offset, int $limit);
}