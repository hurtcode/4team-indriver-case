<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Forecasting;

use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\Trip\Trip;
use OutDriver\Domain\Driver\PaymentGoals;
use OutDriver\Domain\Driver\Forecasting\Amortization\Amortization;
use OutDriver\Infrastructure\Persistence\TripHistory\TripRepository;

final class ForecastingService
{
    public function __construct(
        private readonly TripRepository $repository,
        private readonly Amortization $amortization,
    ) {
    }

    public function planGoals(Driver $driver, float $goal): PaymentGoals
    {
        $distancePerMonth = $this->distancePerMonth($driver);

        $amortization = $this->amortization->amortization($driver);

        $minimalAdditionalPayment = ($goal / $distancePerMonth) + $amortization;
        return new PaymentGoals($goal, $minimalAdditionalPayment);
    }

    private function paymentGoal(Driver $driver): float
    {
        return $driver->paymentGoal()->goal();
    }

    private function distancePerMonth(Driver $driver): float
    {
        $trips = $this
            ->repository
            ->getForMonth($driver->id());

        if (empty($trips)) {
            return 0;
        }

        return array_sum(
            array_map(function (Trip $trip) {
                return $trip->distance();
            }, $trips)
        );
    }
}