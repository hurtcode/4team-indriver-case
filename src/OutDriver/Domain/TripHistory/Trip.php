<?php

declare(strict_types=1);

namespace OutDriver\Domain\TripHistory;

final class Trip
{
    public function __construct(
        private readonly float              $cost,
        private readonly float              $distance,
        private readonly \DatePeriod        $spentTime,
        private readonly \DateTimeImmutable $date,
    )
    {
    }
}