<?php

declare(strict_types=1);

namespace OutDriver\Application\Dto;

final class AmortizationResponse
{
    public function __construct(
        public readonly float $amortization,
        public readonly float $minimumTripCost,
        public readonly float $paymentGoals
    )
    {
    }
}