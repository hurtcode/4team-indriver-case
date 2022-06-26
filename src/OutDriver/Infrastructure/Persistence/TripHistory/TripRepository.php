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

	public function save(Trip $trip): void
	{
		try {
			$this->transaction()->persist($trip);
		} catch (\Throwable $t) {
			throw new \RuntimeException("Impossible to persist trip data: {$t->getMessage()}", 500, $t);
		}
	}

	public function getForMonth(): array
	{
		try {
			$previousMonth = date(
				'Y-m-d', strtotime(date('Y-m') . "-1 month")
			);

			$nextMonth = date(
				'Y-m-d', strtotime(date('Y-m') . "+1 month")
			);

			return $this->repository()->select()
				->where('date', '>', $previousMonth)
				->andWhere('date', '<', $nextMonth)
				->fetchAll();


		} catch (\Throwable $t) {
			throw new \RuntimeException("Impossible to fetch trip data by month: {$t->getMessage()}", 500, $t);
		}
	}

	public function getAllBySpec(string $driverPhone, int $offset, int $limit)
	{
		try {
			return $this->repository()
				->select()
				->where(['phone' => $driverPhone])
				->limit($limit)
				->offset($offset)
				->fetchAll();

		} catch (\Throwable $t) {
			throw new \RuntimeException("Impossible to fetch trip data by specification: {$t->getMessage()}", 500, $t);
		}
	}
}