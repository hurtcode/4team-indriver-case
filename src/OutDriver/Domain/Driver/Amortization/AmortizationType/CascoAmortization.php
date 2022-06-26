<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Amortization\AmortizationType;

use OutDriver\Domain\Driver\Amortization\AmortizationType;
use OutDriver\Domain\Driver\Driver;

final class CascoAmortization implements AmortizationType
{
	private function __construct(
		// TODO: Add Facade for ESBD system!
	)
	{
	}

	public function amortization(Driver $driver): float
	{
		// TODO: return $this->cascoFacade->cascoForDriver($driver)
		return 0.0;
	}
}