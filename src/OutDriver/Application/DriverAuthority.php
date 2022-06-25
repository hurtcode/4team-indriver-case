<?php

declare(strict_types=1);

namespace OutDriver\Application;

final class DriverAuthority
{
    public function __construct(
        public readonly string $phone,
    ) {
    }
}