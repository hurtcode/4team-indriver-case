<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Amortization;

use OutDriver\Domain\Driver\Driver;

interface AmortizationType
{
	public function amortization(Driver $driver);
}