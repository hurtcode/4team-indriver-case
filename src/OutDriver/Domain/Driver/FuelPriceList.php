<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

interface FuelPriceList
{
    public function priceFor(FuelType $octat): float;
}