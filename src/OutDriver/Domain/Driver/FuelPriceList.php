<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

use OutDriver\Domain\Driver\Car\FuelType;

interface FuelPriceList
{
    public function priceFor(FuelType $octaneValue): float;
}