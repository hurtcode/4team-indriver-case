<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Amortization\AmortizationType;

use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\Car\FuelType;
use OutDriver\Domain\Driver\FuelPriceList;
use OutDriver\Domain\Driver\Amortization\AmortizationType;

final class FuelAmortization implements AmortizationType
{
	public function __construct(
		private readonly FuelPriceList $priceList,
	)
	{
	}

	public function amortization(Driver $driver): float
	{
		return $this->fuelPerKm($driver);
	}

	private function fuelPerKm(Driver $driver): float
	{
		$engine = $driver->car()->engine();
		$fuelPrice = $this->fuelPriceFor($driver);

		return (($engine->gasConsumption() * $fuelPrice) / 100);
	}

	private function fuelPriceFor(Driver $driver): float
	{
		$preferableFuel = $driver->car()->preferableFuel()
			?? FuelType::AI95;

		return $this->priceList->priceFor($preferableFuel);
	}
}