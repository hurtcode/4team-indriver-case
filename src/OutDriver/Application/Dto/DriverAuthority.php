<?php

declare(strict_types=1);

namespace OutDriver\Application\Dto;

final class DriverAuthority
{
    public function __construct(
        public readonly int $id,
        public readonly string $phone,
        public readonly float $goal
    ) {
    }
}