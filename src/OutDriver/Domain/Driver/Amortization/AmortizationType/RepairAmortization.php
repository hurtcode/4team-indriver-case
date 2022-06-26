<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Amortization\AmortizationType;

use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\Amortization\AmortizationType;

final class RepairAmortization implements AmortizationType
{
	public function amortization(Driver $driver): float
	{
		return $this->averageFixPrice($driver);
	}

	private function averageFixPrice(Driver $driver): float
	{
		$car = $driver->car();
		return empty($car->repairHistory())
			? 0
			: $car->repairHistory()->averageFixPrice() / $car->repairHistory()->fixInterval();
	}
}