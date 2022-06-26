<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\Embedded;
use Cycle\Annotated\Annotation\Relation\HasOne;
use OutDriver\Domain\Driver\Car\Car;
use OutDriver\Domain\Driver\Car\Category;
use OutDriver\Domain\Driver\Car\Engine;
use OutDriver\Domain\Driver\Car\FuelType;
use OutDriver\Domain\Driver\Car\History\ExploitationHistory;
use OutDriver\Domain\Driver\Car\History\RepairHistory;
use OutDriver\Domain\Driver\Trip\Trip;

#[Entity(table: 'driver', database: 'default')]
class Driver
{
    #[Column(type: 'primary', name: 'id')]
    private readonly int $id;
    #[Column(type: 'string', name: 'phone')]
    private string $phone;
    #[Column(type: 'string', name: 'password')]
    private string $password;
    #[Embedded(PaymentGoals::class, load: 'eager')]
    private PaymentGoals $goals;

    #[HasOne(target: Car::class, innerKey: 'id', outerKey: 'driverId', load: 'eager')]
    private Car $car;

    public function __construct(
        string $phone,
        string $password,
        ?PaymentGoals $goals = null,
    ) {
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
    ): Trip {
        return new Trip(
            $this->id(),
            $cost,
            $distance,
            $spentTime,
            $date
        );
    }

    public function addCar(
        float $price,
        Engine $engine,
        Category $category,
        FuelType $fuelType
    ): void {
        $this->car = new Car(
            $this->id(),
            $price,
            $engine,
            $category,
            $fuelType,
            new ExploitationHistory(null, null),
            new RepairHistory(null, null),
        );
    }
}