<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Trip;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(table: 'trip', database: 'default')]
final class Trip
{
    #[Column(type: 'primary', name: 'id', primary: true)]
    private int $id;

    public function __construct(
        #[Column(type: 'integer', name: 'driverId')]
        private int $driverId,
        #[Column(type: 'float', name: 'cost')]
        private float $cost,
        #[Column(type: 'float', name: 'distance')]
        private float $distance,
        #[Column(type: 'datetime', name: 'spentTime')]
        private \DateTimeImmutable $spentTime,
        #[Column(type: 'datetime', name: 'date')]
        private \DateTimeImmutable $date,
    ) {
    }

    public function distance(): float
    {
        return $this->distance;
    }

    public function cost(): float
    {
        return $this->cost;
    }

    public function spentTime(): string
    {
        return $this->spentTime->format('H:i:s');
    }

    public function date(): string
    {
        return $this->date->format('d-m-Y');
    }
}