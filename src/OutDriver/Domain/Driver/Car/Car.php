<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car;

final class Car
{
    private string $model;
    private Engine $engine;
    private Category $category;
    private ?ExploitationHistory $history;

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
}