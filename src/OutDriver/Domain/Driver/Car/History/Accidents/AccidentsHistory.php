<?php

namespace OutDriver\Domain\Driver\Car\History\Accidents;

class AccidentsHistory
{
    /** @var Accidents[] */
    private array $accidentsHistory = [];

    public function addAccident(Accidents $accident): void
    {
        $this->accidentsHistory[] = $accident;
    }
}