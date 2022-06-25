<?php

declare(strict_types=1);

namespace OutDriver\Infrastructure\TripHistory;

use OutDriver\Domain\TripHistory\Trip;
use OutDriver\Infrastructure\Persistence\AbstractRepository;

final class TripRepository
    extends AbstractRepository
    implements \OutDriver\Domain\TripHistory\TripRepository
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
        }
    }

    public function getForMonth(): array
    {
        try {

        } catch (\Throwable $t) {
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
        }
    }
}