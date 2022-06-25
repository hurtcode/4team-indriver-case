<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

use OutDriver\Domain\Driver\FuelType;

final class Car
{
    private string $model;
    private readonly float $price;

    private Engine $engine;
    private Category $category;
    private ?FuelType $preferableFuel;
    private ?ExploitationHistory $history = null;
    private ?RepairHistory $repairHistory = null;

    public function __construct(
        string $model,
        Engine $engine,
        string $category,
    )
    {
        $this->setModel($model);
        $this->setEngine($engine);
        $this->setCategory($category);
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setEngine(Engine $engine): void
    {
        $this->engine = $engine;
    }

    public function setCategory(string $category): void
    {
        $this->category = Category::from($category);
    }

    public function engine(): Engine
    {
        return $this->engine;
    }

    public function exploitationHistory(): ExploitationHistory
    {
        return $this->history;
    }

    public function preferableFuel(): ?FuelType
    {
        return $this->preferableFuel;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function repairHistory(): RepairHistory {
        return $this->repairHistory;
    }
}