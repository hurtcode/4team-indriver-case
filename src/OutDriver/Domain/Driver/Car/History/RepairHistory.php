<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car\History;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;

#[Embeddable]
final class RepairHistory
{
    #[Column(type: 'float', name: 'averageFixPrice')]
    private float $averageFixPrice;
    #[Column(type: 'float', name: 'fixInterval')]
    private float $fixInterval; // How often you repair your car in km

    public function __construct()
    {
    }

    public function averageFixPrice(): float
    {
        return $this->averageFixPrice;
    }

    public function fixInterval(): float
    {
        return $this->fixInterval;
    }
}