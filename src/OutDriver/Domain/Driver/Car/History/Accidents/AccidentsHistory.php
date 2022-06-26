<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car\History\Accidents;

use DateTime;

final class AccidentsHistory implements \Stringable
{
	/** @var Accident[] */
	private array $accidents = [];

	public function addAccident(Accident $accident): void
	{
		$this->accidents[] = $accident;
	}

	public function empty(): bool
	{
		return empty($this->accidents);
	}

	public static function typecast(string $accidents): AccidentsHistory
	{
		$history = new AccidentsHistory();
		foreach (json_decode($accidents) as $accident) {
			$history->addAccident(
				new Accident(
					$accident->reason,
					DateTime::createFromFormat('Y-m-d H:i:s', $accident->date)
				)
			);
		}
		return $history;
	}

	public function __toString(): string
	{
		return json_encode(
			array_map(function (Accident $accident) {
				return [
					'reason' => $accident->reason(),
					'date' => $accident->date()->format('Y-m-d H:i:s'),
				];
			}, $this->accidents)
		);
	}
}