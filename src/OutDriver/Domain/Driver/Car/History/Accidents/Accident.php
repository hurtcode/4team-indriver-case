<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car\History\Accidents;

final class Accident
{
	public function __construct(
		private string $reason,
		private \DateTimeInterface $date,
	)
	{
	}

	public function reason(): string
	{
		return $this->reason;
	}

	public function date(): \DateTimeInterface
	{
		return $this->date;
	}
}