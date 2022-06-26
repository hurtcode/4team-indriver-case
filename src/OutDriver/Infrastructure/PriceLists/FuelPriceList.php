<?php

declare(strict_types=1);

namespace OutDriver\Infrastructure\PriceLists;

use OutDriver\Domain\Driver\Car\FuelType;

final class FuelPriceList
	implements \OutDriver\Domain\Driver\FuelPriceList
{
	private array $mockedPrices = [
		'AI92' => 180,
		'AI95' => 212,
		'AI98' => 230
	];

	public function priceFor(FuelType $octaneValue): float
	{
		$fuelType = $octaneValue->name;
		if (isset($this->mockedPrices[$fuelType]))
			return $this->mockedPrices[$fuelType];

		return 200;
	}
}