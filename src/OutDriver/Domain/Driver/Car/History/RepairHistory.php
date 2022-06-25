<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

final class RepairHistory
{
    private float $averageFixPrice;
    private float $fixInterval; // How often you repair your car in km

    public function __construct()
    {
    }
}