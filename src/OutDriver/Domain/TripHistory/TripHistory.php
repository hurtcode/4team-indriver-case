<?php

declare(strict_types=1);

namespace OutDriver\Domain\TripHistory;

final class TripHistory
{
    /** @var Trip[] */
    private array $trips = [];

    public function addTrip(Trip $trip): void
    {
        $this->trips[] = $trip;
    }
}