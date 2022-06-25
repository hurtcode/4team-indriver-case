<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\Embedded;
use OutDriver\Domain\Driver\Car\Car;

#[Entity(table: 'driver', database: 'outdriver')]
final class Driver
{
    #[Embedded(Car::class)]
    private Car $car;
    #[Column(type: 'integer', name: 'id', primary: true)]
    private readonly int $id;
    #[Column(type: 'string', name: 'phone', primary: true)]
    private string $phone;
    #[Column(type: 'string', name: 'password')]
    private string $password;
    #[Embedded(PaymentGoals::class)]
    private PaymentGoals $goals;

    public function __construct(
        int    $id,
        Car    $car,
        string $phone,
        string $password
    )
    {
        $this->setGoals();
        $this->setCar($car);
        $this->setIdentity($id, $phone, $password);
    }

    private function setGoals(): void
    {
        $this->goals = new PaymentGoals();
    }

    private function setCar(Car $car): void
    {
        $this->car = $car;
    }

    private function setIdentity(int $id, string $phone, string $password): void
    {
        $this->id = $id;
        $this->phone = $phone;
        $this->password = $password;
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
}