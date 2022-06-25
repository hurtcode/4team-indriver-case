<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Amortization;

use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\FuelType;
use OutDriver\Domain\TripHistory\Trip;
use OutDriver\Domain\Driver\FuelPriceList;
use OutDriver\Domain\TripHistory\TripRepository;

final class Amortization
{
    public function __construct(
        private readonly FuelPriceList    $priceList,
        private readonly TripRepository   $tripRepository,
    )
    {
    }

    public function amortization(Driver $driver): float
    {
        $fuelPerKm = $this->fuelPerKm($driver);
        $carAmortization = $this->carAmortization($driver);
        $averageFixPrice = $this->averageFixPrice($driver);

        return $fuelPerKm + $carAmortization + $averageFixPrice;
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

    private function carAmortization(Driver $driver): float
    {
        $averageDistancePerYear = $this
            ->averageDistancePerYear();

        $amortizationPerYear = $driver->car()->price();
        return $amortizationPerYear / $averageDistancePerYear;
    }

    private function averageDistancePerYear(): float
    {
        $trips = $this->tripRepository->getForMonth();
        $distancePerMonth = array_sum(
            array_map(function (Trip $trip) {
                return $trip->distance();
            }, $trips)
        );

        return $distancePerMonth * 12;
    }

    private function averageFixPrice(Driver $driver): float
    {
        $car = $driver->car();
        return empty($car->repairHistory())
            ? 0
            : $car->repairHistory()->averageFixPrice() / $car->repairHistory()->fixInterval();
    }
}