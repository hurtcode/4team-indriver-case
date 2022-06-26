<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\Embedded;
use Cycle\Annotated\Annotation\Relation\HasOne;
use OutDriver\Domain\Driver\Car\Car;
use OutDriver\Domain\Driver\Trip\Trip;

#[Entity(table: 'driver', database: 'default')]
final class Driver
{
	#[Column(type: 'primary', name: 'id', primary: true)]
	private readonly int $id;
	#[Column(type: 'string', name: 'phone', primary: true)]
	private string $phone;
	#[Column(type: 'string', name: 'password')]
	private string $password;
	#[Embedded(PaymentGoals::class)]
	private PaymentGoals $goals;

	#[HasOne(target: Car::class, outerKey: 'driverId')]
	private Car $car;

	public function __construct(
		string $phone,
		string $password,
		?PaymentGoals $goals = null,
	)
	{
		$this->phone = $phone;
		$this->password = $password;
		$this->goals = $goals ?? new PaymentGoals();
	}

	public function id(): int
	{
		return $this->id;
	}

	public function phone(): string
	{
		return $this->phone;
	}

	public function car(): Car
	{
		return $this->car;
	}

	public function paymentGoal(): PaymentGoals
	{
		return $this->goals;
	}

	public function planGoals(PaymentGoals $goals): void
	{
		$this->goals = $goals;
	}

	public function makeTrip(
		float $cost,
		float $distance,
		\DateTimeImmutable $spentTime,
		\DateTimeImmutable $date
	): Trip
	{
		return new Trip($this->id(), $cost, $distance, $spentTime, $date);
	}
}