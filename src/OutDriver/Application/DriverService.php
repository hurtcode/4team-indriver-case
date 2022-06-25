<?php

declare(strict_types=1);

namespace OutDriver\Application;

final class DriverService
{
    /**
     * Finds Driver for auth session. Returns null if no
     * matched driver by phone
     */
    public function driverByIdentity(string $phone): ?DriverAuthority
    {
        // TODO::MOCK BELOW
        return $phone === "77765056090" ? new DriverAuthority("77765056090") : null;
    }

    public function authorize(string $phone, string $password): ?DriverAuthority
    {
        // TODO::MOCK BELOW
        return ($phone === "77765056090" && $password === '123456') ? new DriverAuthority("77765056090") : null;
    }
}