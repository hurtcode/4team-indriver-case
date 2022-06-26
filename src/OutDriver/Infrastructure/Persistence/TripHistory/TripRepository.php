<?php

declare(strict_types=1);

namespace OutDriver\Infrastructure\Persistence\TripHistory;

use OutDriver\Domain\Driver\Trip\Trip;
use OutDriver\Infrastructure\Persistence\AbstractRepository;

final class TripRepository
	extends AbstractRepository
	implements \OutDriver\Domain\Driver\Trip\TripRepository
{
	protected function entity(): string
	{
		return Trip::class;
	}

	public function persists(Trip &$trip): void
	{
		try {
			$this->transaction()->persist($trip)->run();
		} catch (\Throwable $t) {
			throw new \RuntimeException("Impossible to persist trip data: {$t->getMessage()}", 500, $t);
		}
	}

	public function getForMonth(int $driverId): array
	{
		try {
			$nextMonth = date('Y-m-d', strtotime('+1 month', time()));
			$previousMonth = date('Y-m-d', strtotime('-1 month', time()));


			return $this->repository()->select()
				->where('date', '>', $previousMonth)
				->andWhere('date', '<', $nextMonth)
				->andWhere('driverId', '=', $driverId)
				->fetchAll();
		} catch (\Throwable $t) {
			throw new \RuntimeException("Impossible to fetch trip data by month: {$t->getMessage()}", 500, $t);
		}
	}

	public function getByYear(int $driverId): array
	{
		try {
			$nextYear = date('Y-m-d', strtotime('+1 year', time()));
			$previousYear = date('Y-m-d', strtotime('-1 year', time()));

			return $this->repository()->select()
				->where('date', '>', $previousYear)
				->andWhere('date', '<', $nextYear)
				->andWhere('driverId', '=', $driverId)
				->fetchAll();
		} catch (\Throwable $t) {
			throw new \RuntimeException("Impossible to fetch trip data by month: {$t->getMessage()}", 500, $t);
		}
	}

	public function getAllBySpec(int $driverId, int $offset, int $limit)
	{
		try {
			return $this->repository()
				->select()
				->where(['driverId' => $driverId])
				->limit($limit)
				->offset($offset)
				->fetchAll();
		} catch (\Throwable $t) {
			throw new \RuntimeException("Impossible to fetch trip data by specification: {$t->getMessage()}", 500, $t);
		}
	}


	public function allTripsCount(int $driverId): int
	{
		return $this->repository()->select()
			->where(['driverId' => $driverId])
			->count();
	}
}