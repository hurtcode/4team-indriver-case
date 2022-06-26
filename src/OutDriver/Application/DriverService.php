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
	)
	{
	}

	/**
	 * Finds Driver for auth session. Returns null if no
	 * matched driver by phone
	 */
	public function driverByIdentity(string $phone): ?DriverAuthority
	{
		// TODO::MOCK BELOW
		return $phone === "77765056090" ? new DriverAuthority("77765056090") : null;
	}

	public function authorize(string $phone, string $password): ?DriverAuthority
	{
		// TODO::MOCK BELOW
		return ($phone === "77765056090" && $password === '123456') ? new DriverAuthority("77765056090") : null;
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
	): void
	{
		$driver = $this
			->driverRepository
			->byPhone($driverPhone);

		$trip = $driver->makeTrip(
			$cost,
			$distance,
			\DateTimeImmutable::createFromFormat('h:i:s', $spentTime),
			\DateTimeImmutable::createFromFormat('Y-m-d', $date)
		);

		$this->tripRepository->save($trip);
	}

	/** @return Trip[] */
	public function allTrips(string $driverPhone, int $offset, int $limit): array
	{
		return $this->tripRepository->getAllBySpec($driverPhone, $offset, $limit);
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

	public function getPlannedGoals(string $driverPhone): Driver
	{
		return $this->driverRepository->byPhone($driverPhone);
	}

	public function amortization(int $driverId): AmortizationResponse
	{
		$driver = $this->driverRepository->byId($driverId);
		$amortization = $this->amortization->amortization($driver);

		return new AmortizationResponse(
			$amortization,
			$driver->paymentGoal()->goal()
		);
	}
}