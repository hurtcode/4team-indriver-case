<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Embeddable;
use Cycle\Annotated\Annotation\Relation\Embedded;
use OutDriver\Domain\Driver\Car\History\RepairHistory;
use OutDriver\Domain\Driver\Car\History\ExploitationHistory;

#[Embeddable]
final class Car
{
    #[Column(type: 'string', name: 'model')]
    private string $model;
    #[Column(type: 'float', name: 'price')]
    private readonly float $price;

    #[Embedded(Engine::class)]
    private Engine $engine;
    #[Embedded(Category::class)]
    private Category $category;
    #[Embedded(FuelType::class)]
    private ?FuelType $preferableFuel;
    #[Embedded(ExploitationHistory::class)]
    private ?ExploitationHistory $history = null;
    #[Embedded(RepairHistory::class)]
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

    public function repairHistory(): RepairHistory
    {
        return $this->repairHistory;
    }
}