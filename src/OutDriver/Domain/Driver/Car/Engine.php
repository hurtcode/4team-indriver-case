<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

use Exception;

final class Engine
{
    private float $GasConsumption;

    /** @throws Exception */
    public function __construct(
        float $avgGasConsumption,
    )
    {
        $this->setAvgGasConsumption($avgGasConsumption);
    }

    /** @throws Exception */
    public function setAvgGasConsumption(float $GasConsumption): void
    {
        if ($this->GasConsumption < 0)
            throw new Exception("Invalid Gas consumption metric! It should be higher then 0");

        $this->GasConsumption = $GasConsumption;
    }
}