<?php

declare(strict_types=1);

namespace OutDriver\Application;

use DomainException;
use RuntimeException;
use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\Trip\Trip;
use OutDriver\Domain\Driver\DriverRepository;
use OutDriver\Application\Dto\DriverAuthority;
use OutDriver\Domain\Driver\Trip\TripRepository;
use OutDriver\Application\Dto\AmortizationResponse;
use OutDriver\Domain\Driver\Forecasting\ForecastingService;
use OutDriver\Domain\Driver\Forecasting\Amortization\Amortization;

final class DriverService
{
    public function __construct(
        private readonly Amortization $amortization,
        private readonly TripRepository $tripRepository,
        private readonly DriverRepository $driverRepository,
        private readonly ForecastingService $forecastingService,
    ) {
    }

    /**
     * Finds Driver for auth session. Returns null if no
     * matched driver by phone
     */
    public function driverByIdentity(string $phone): ?DriverAuthority
    {
        $driver = $this
            ->driverRepository
            ->byPhone($phone);

        return empty($driver)
            ? null
            : new DriverAuthority(
                $driver->id(),
                $driver->phone(),
                $driver->paymentGoal()->goal()
            );
    }

    public function authorize(string $phone, string $password): ?DriverAuthority
    {
        $driver = $this->driverRepository->byPhone($phone);

        if (empty($driver)) {
            return null;
        }

        return $driver->password() === $password
            ? new DriverAuthority($driver->id(), $driver->phone())
            : null;
    }

    /**
     * @throws DomainException
     * @throws RuntimeException
     */
    public function addTrip(
        string $driverPhone,
        float $cost,
        float $distance,
        string $spentTime,
        string $date
    ): void {
        $driver = $this
            ->driverRepository
            ->byPhone($driverPhone);

        $trip = $driver->makeTrip(
            $cost,
            $distance,
            \DateTimeImmutable::createFromFormat('H:i:s', $spentTime),
            \DateTimeImmutable::createFromFormat('d-m-Y', $date)
        );

        $this->tripRepository->persists($trip);
    }

    /** @return Trip[] */
    public function allTrips(int $driverId, int $offset, int $limit): array
    {
        return $this->tripRepository->getAllBySpec($driverId, $offset, $limit);
    }

    public function allTripsCount(int $driverId): int
    {
        return $this->tripRepository->allTripsCount($driverId);
    }

    public function planGoals(string $driverPhone, float $goals): void
    {
        $driver = $this
            ->driverRepository
            ->byPhone($driverPhone);

        $driver->planGoals(
            $this->forecastingService->planGoals($driver, $goals)
        );

        $this->driverRepository->persist($driver);
    }

	public function getDrivePrice(string $driverPhone): float
	{
		$driver = $this->driverRepository->byPhone($driverPhone);
		return $driver->paymentGoal()->additionalPayment();
	}

    public function amortization(int $driverId): AmortizationResponse
    {
        $driver = $this->driverRepository->byId($driverId);
        $amortization = $this->amortization->amortization($driver);

		return new AmortizationResponse($amortization);
	}
}