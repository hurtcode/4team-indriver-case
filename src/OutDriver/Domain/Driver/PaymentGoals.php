<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;

#[Embeddable]
class PaymentGoals
{
    public function __construct(
        #[Column(type: 'float', name: 'paymentGoal')]
        private float $paymentGoal = 300000,
        #[Column(type: 'float', name: 'minimalAdditionalPayment')]
        private float $minimalAdditionalPayment = 0,
    )
    {
    }

    public function goal(): float
    {
        return $this->paymentGoal;
    }

    public function additionalPayment(): float
    {
        return $this->minimalAdditionalPayment;
    }
}