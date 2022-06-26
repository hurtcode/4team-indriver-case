<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Amortization;

use OutDriver\Domain\Driver\Driver;

final class Amortization
{
	public function __construct(
		/** @var AmortizationType[] */
		private readonly array $pipes = []
	)
	{
	}

	public function amortization(Driver $driver): float
	{
		$cost = 0.0;

		/** @var AmortizationType $pipe */
		foreach ($this->pipes as $pipe)
			$cost += $pipe->amortization($driver);

		return $cost;
	}
}