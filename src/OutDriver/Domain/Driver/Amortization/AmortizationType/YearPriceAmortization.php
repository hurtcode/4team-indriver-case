<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Amortization\AmortizationType;

use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\Trip\Trip;
use OutDriver\Domain\Driver\Trip\TripRepository;
use OutDriver\Domain\Driver\Amortization\AmortizationType;

final class YearPriceAmortization implements AmortizationType
{
	public function __construct(
		private readonly TripRepository $repository
	)
	{
	}

	public function amortization(Driver $driver): float
	{
		return $this->carAmortization($driver);
	}

	private function carAmortization(Driver $driver): float
	{
		$averageDistancePerYear = $this
			->averageDistancePerYear();

		$amortizationPerYear = $driver->car()->price();
		return $amortizationPerYear / $averageDistancePerYear;
	}

	private function averageDistancePerYear(): float
	{
		$trips = $this->repository->getForMonth();
		$distancePerMonth = array_sum(
			array_map(function (Trip $trip) {
				return $trip->distance();
			}, $trips)
		);

		return $distancePerMonth * 12;
	}
}