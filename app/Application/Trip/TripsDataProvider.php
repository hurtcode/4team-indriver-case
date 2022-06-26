<?php

declare(strict_types=1);

namespace OutDriver\Yii\Application\Trip;

use OutDriver\Application\DriverService;
use yii\data\BaseDataProvider;

final class TripsDataProvider extends BaseDataProvider
{
    private DriverService $driverService;

    public function init()
    {
        parent::init();
        $this->driverService = \Yii::$container->get(DriverService::class);
    }

    protected function prepareModels(): array
    {
        $driverId = \Yii::$app->user->getIdentity()->authority()->id;
        $this->pagination->totalCount = $this->driverService->allTripsCount($driverId);

        $trips = $this->driverService->allTrips(
            $driverId,
            $this->getPagination()->getOffset(),
            $this->getPagination()->getLimit(),
        );

        foreach ($trips as $index => $trip) {
            $trips[$index] = [
                'id' => $trip->id(),
                'cost' => $trip->cost(),
                'distance' => $trip->distance(),
                'date' => $trip->date(),
                'spendTime' => $trip->spentTime()
            ];
        }

        return $trips;
    }

    protected function prepareKeys($models)
    {
        return array_keys($models);
    }

    protected function prepareTotalCount(): int
    {
        $driverId = \Yii::$app->user->getIdentity()->authority()->id;
        return $this->driverService->allTripsCount($driverId);
    }
}