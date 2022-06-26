<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car\History;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;

#[Embeddable]
final class RepairHistory
{
    public function __construct(
        #[Column(type: 'float', name: 'averageFixPrice', nullable: true)]
        private ?float $averageFixPrice,
        #[Column(type: 'float', name: 'fixInterval', nullable: true)]
        private ?float $fixInterval
    ) {
    }


    public function averageFixPrice(): ?float
    {
        return $this->averageFixPrice;
    }

    public function fixInterval(): ?float
    {
        return $this->fixInterval;
    }
}