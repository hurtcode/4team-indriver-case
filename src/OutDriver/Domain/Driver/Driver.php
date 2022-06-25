<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver;

use OutDriver\Domain\Driver\Car\Car;

final class Driver
{
    private Car $car;
    private readonly int $id;
    private string $phone;
    private string $password;

    public function __construct(int $id, Car $car, string $phone, string $password)
    {
        $this->setCar($car);
        $this->setIdentity($id, $phone, $password);
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
}