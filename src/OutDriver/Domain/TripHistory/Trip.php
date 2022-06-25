<?php

declare(strict_types=1);

namespace OutDriver\Domain\TripHistory;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
use OutDriver\Domain\Driver\Driver;

#[Entity(table: 'trip')]
final class Trip
{
    public function __construct(
        #[BelongsTo(target: Driver::class)]
        private readonly Driver $driver,
        #[Column(type: 'float', name: 'cost')]
        private readonly float              $cost,
        #[Column(type: 'float', name: 'distance')]
        private readonly float              $distance,
        #[Column(type: 'datetime', name: 'spentTime')]
        private readonly \DateTimeImmutable $spentTime,
        #[Column(type: 'datetime', name: 'date')]
        private readonly \DateTimeImmutable $date,
    )
    {
    }

    public function distance(): float
    {
        return $this->distance;
    }
}