<?php

declare(strict_types=1);

namespace OutDriver\Application;

final class TripInfo
{
    public function __construct(
        public readonly string $date,
        public readonly float $coast,
        public readonly string $spentTime,
        public readonly int $distance,
    ) {
    }
}