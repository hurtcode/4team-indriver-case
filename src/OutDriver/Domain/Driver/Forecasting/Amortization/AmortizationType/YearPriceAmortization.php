<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Forecasting\Amortization\AmortizationType;

use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\Forecasting\Amortization\AmortizationType;
use OutDriver\Domain\Driver\Trip\Trip;
use OutDriver\Domain\Driver\Trip\TripRepository;

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
		$averageDistancePerKm = $this
			->averageDistancePerYear($driver->id());
		return $this->getFacticalCarState($driver, $averageDistancePerKm);
	}

	private function getFacticalCarState(Driver $driver, float $averageDisntacePerKm): float
	{
		$exploitationDate = $driver->car()->exploitationHistory();
		$startExploitationDate = $exploitationDate->exploitationYear() ??
			\DateTimeImmutable::createFromFormat('Y-m-d', "2010-01-01");

		$maxState = 100;
		$currentState = (new \DateTimeImmutable())->diff($startExploitationDate);
		$lostPercentage = ((int)$currentState->y / 5) * -5; // Should be no more than 50 percent

		if ($lostPercentage > 50)
			$lostPercentage = 50;

		$lostPercentage = ($maxState - abs($lostPercentage)) / 100;

		return (($driver->car()->price() * ($lostPercentage / 20)) / 12) / $averageDisntacePerKm;
	}

	private function averageDistancePerYear(int $driverId): float
	{
		$trips = $this->repository->getForMonth($driverId);
		return array_sum(
			array_map(function (Trip $trip) {
				return $trip->distance();
			}, $trips)
		);
	}
}