<?php

declare(strict_types=1);

namespace OutDriver\Infrastructure\Persistence;

use BackedEnum;
use Cycle\ORM\Exception\TypecastException;
use Cycle\ORM\Parser\CastableInterface;
use Cycle\ORM\Parser\UncastableInterface;
use Throwable;

/**
 * Typecast for PHP 8.1 enums.
 * Usage example:
 * ```php
 * // Add Typecast class cast to schema
 * ...
 *
 * // Add your enum in class. Enum class MUST implement
 * // BackedEnum interface, i.e. MUST be typed
 * #[Column(typecast:SomeEnum::class)]
 * private SomeEnum $property
 *
 * ```
 */
final class EnumTypecast implements CastableInterface, UncastableInterface
{
    /** @psalm-var array<string, class-string<BackedEnum>> */
    private array $rules = [];

    public function setRules(array $rules): array
    {
        foreach ($rules as $property => $enum) {
            if (
                is_string($enum) &&
                in_array(BackedEnum::class, class_implements($enum))
            ) {
                $this->rules[$property] = $enum;
                unset($rules[$property]);
            }
        }
        return $rules;
    }

    public function cast(array $data): array
    {
        try {
            foreach ($this->rules as $property => $enum) {
                $value = $data[$property] ?? null;
                if (!is_null($value)) {
                    $data[$property] = call_user_func_array([$enum, 'from'], ['value' => $value]);
                }
            }
        } catch (Throwable $t) {
            throw new TypecastException(
                sprintf('Unable to typecast enum: %s', $t->getMessage()),
                $t->getCode(),
                $t
            );
        }
        return $data;
    }

    public function uncast(array $data): array
    {
        foreach ($data as $property => &$enum) {
            if (isset($this->rules[$property])) {
                /** @psalm-var BackedEnum $enum */
                $enum = $enum->value;
            }
        }
        return $data;
    }
}
