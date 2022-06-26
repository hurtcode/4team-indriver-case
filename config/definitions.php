<?php

use Cycle\ORM\ORM;
use OutDriver\Domain\Driver\Forecasting\Amortization\Amortization;
use OutDriver\Domain\Driver\Forecasting\Amortization\AmortizationType\FuelAmortization;
use OutDriver\Domain\Driver\Forecasting\Amortization\AmortizationType\RepairAmortization;
use OutDriver\Domain\Driver\Forecasting\Amortization\AmortizationType\YearPriceAmortization;
use OutDriver\Yii\Db\OrmFactory;
use OutDriver\Yii\Db\SchemaGenerator;
use yii\di\Instance;

return [
    'definitions' => [
        ORM::class => function (\yii\di\Container $c) {
            return (new OrmFactory(
                $dbal = Yii::$app->params['db']['dbal'],
                (new SchemaGenerator($dbal, Yii::getAlias('@app/src')))()
            ))();
        },

        \OutDriver\Domain\Driver\DriverRepository::class => Instance::of(
            \OutDriver\Infrastructure\Persistence\Driver\DriverRepository::class
        ),

        \OutDriver\Domain\Driver\Trip\TripRepository::class => Instance::of(
            \OutDriver\Infrastructure\Persistence\TripHistory\TripRepository::class
        ),

        Amortization::class => function (\yii\di\Container $c) {
            return new Amortization([
                $c->get(FuelAmortization::class),
                $c->get(YearPriceAmortization::class),
                $c->get(RepairAmortization::class),
            ]);
        },

        \OutDriver\Domain\Driver\FuelPriceList::class => Instance::of(
            \OutDriver\Infrastructure\PriceLists\FuelPriceList::class
        )
    ],
    'singletons' => []
];