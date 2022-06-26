<?php

declare(strict_types=1);

namespace OutDriver\Yii\Application\Driver;

use yii\web\IdentityInterface;
use OutDriver\Application\DriverService;
use OutDriver\Application\Dto\DriverAuthority;

final class ApplicationUser implements IdentityInterface
{
    public function __construct(
        private readonly DriverAuthority $authority
    ) {
    }

    public static function findIdentity($id): ?IdentityInterface
    {
        $authority = \Yii::$container->get(DriverService::class)
            ->driverByIdentity((string)$id);
        return is_null($authority) ? null : new ApplicationUser($authority);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId(): string
    {
        return $this->authority->phone;
    }

    public function authority(): DriverAuthority
    {
        return $this->authority;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey): bool
    {
        return true;
    }
}