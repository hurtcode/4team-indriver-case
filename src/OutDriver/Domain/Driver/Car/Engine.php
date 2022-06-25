<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;
use Exception;

#[Embeddable]
final class Engine
{
    #[Column(type: 'float',name: 'gasConsumption')]
    private float $gasConsumption;

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
        if ($this->gasConsumption < 0)
            throw new Exception("Invalid Gas consumption metric! It should be higher then 0");

        $this->gasConsumption = $GasConsumption;
    }

    public function gasConsumption(): float
    {
        return $this->gasConsumption;
    }
}