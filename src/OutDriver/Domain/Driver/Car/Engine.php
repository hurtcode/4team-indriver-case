<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;
use DomainException;

#[Embeddable]
final class Engine
{
    #[Column(type: 'float', name: 'gasConsumption')]
    private float $gasConsumption;

    /** @throws DomainException */
    public function __construct(
        float $avgGasConsumption,
    ) {
        $this->setAvgGasConsumption($avgGasConsumption);
    }

    /** @throws DomainException */
    public function setAvgGasConsumption(float $GasConsumption): void
    {
        if ($this->gasConsumption < 0) {
            throw new DomainException("Invalid Gas consumption metric! It should be higher then 0");
        }

        $this->gasConsumption = $GasConsumption;
    }

    public function gasConsumption(): float
    {
        return $this->gasConsumption;
    }
}