<?php

declare(strict_types=1);

namespace OutDriver\Yii\Console;

use OutDriver\Domain\Driver\Car\Category;
use OutDriver\Domain\Driver\Car\Engine;
use OutDriver\Domain\Driver\Car\FuelType;
use OutDriver\Domain\Driver\Driver;
use OutDriver\Domain\Driver\DriverRepository;
use yii\console\Controller;
use yii\console\ExitCode;

final class ApplicationController extends Controller
{
    public function actionAddDriver(): int
    {
        $rep = \Yii::$container->get(DriverRepository::class);

        $driver = $rep->byPhone('77765056090');
        if (!is_null($driver)) {
            $this->stdout("Driver is already created");
            return ExitCode::OK;
        }

        try {
            $driver = new Driver(
                '77765056090',
                '123456',
            );
            $rep->persist($driver);

            $driver->addCar(
                10000000.0,
                new Engine(13.3),
                Category::B,
                FuelType::AI95,
            );
            $rep->persist($driver);
        } catch (\Throwable $t) {
            $this->stdout($t->getMessage());
            return ExitCode::UNSPECIFIED_ERROR;
        }

        return ExitCode::OK;
    }
}