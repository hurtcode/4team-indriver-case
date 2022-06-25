<?php

declare(strict_types=1);

namespace OutDriver\Domain\TripHistory;

interface TripRepository
{
    public function getForMonth(): array;
}