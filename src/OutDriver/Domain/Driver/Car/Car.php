<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\Embedded;
use Cycle\ORM\Parser\Typecast;
use OutDriver\Domain\Driver\Car\History\RepairHistory;
use OutDriver\Domain\Driver\Car\History\ExploitationHistory;
use OutDriver\Infrastructure\Persistence\EnumTypecast;

#[Entity(
    table: 'car',
    database: 'default',
    typecast: [
        Typecast::class,
        EnumTypecast::class
    ],
)]
final class Car
{
    #[Column(type: 'primary', name: 'id')]
    private int $carId;
    #[Column(type: 'integer', name: 'driverId')]
    private int $driverId;
    #[Column(type: 'float', name: 'price')]
    private readonly float $price;
    #[Embedded(target: Engine::class)]
    private Engine $engine;
    #[Column(type: 'string', name: 'category', typecast: Category::class)]
    private Category $category;
    #[Column(type: 'integer', name: 'preferableFuel', nullable: true, typecast: FuelType::class)]
    private ?FuelType $preferableFuel;
    #[Embedded(target: ExploitationHistory::class)]
    private ExploitationHistory $history;
    #[Embedded(target: RepairHistory::class)]
    private RepairHistory $repairHistory;

    public function __construct(
        int $driverId,
        string $model,
        Engine $engine,
        string $category,
    ) {
        $this->driverId = $driverId;
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