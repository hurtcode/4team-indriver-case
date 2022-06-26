<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

enum FuelType: int
{
    case AI80 = 80;
    case AI92 = 92;
    case AI95 = 95;
    case AI95P = 96;
    case AI98 = 98;
    case AI100 = 100;
}