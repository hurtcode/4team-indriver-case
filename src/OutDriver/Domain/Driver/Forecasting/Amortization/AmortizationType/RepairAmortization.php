<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Forecasting\Amortization\AmortizationType;

use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\Forecasting\Amortization\AmortizationType;

final class RepairAmortization implements AmortizationType
{
    public function amortization(Driver $driver): float
    {
        return $this->averageFixPrice($driver);
    }

    private function averageFixPrice(Driver $driver): float
    {
        $car = $driver->car();

        $repairHistory = $car->repairHistory();
        return is_null($repairHistory->averageFixPrice()) && is_null($repairHistory->fixInterval())
            ? 0
            : $repairHistory->averageFixPrice() / $repairHistory->fixInterval();
    }
}