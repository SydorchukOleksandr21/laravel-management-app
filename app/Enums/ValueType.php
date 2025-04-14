<?php

namespace App\Enums;

enum ValueType: int
{
    case Number = 0;
    case String = 1;
    case Boolean = 2;

    /**
     * Get a human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Number => 'Number',
            self::String => 'String',
            self::Boolean => 'Boolean',
        };
    }

    /**
     * Convert integer to ValueType.
     */
    public static function fromInt(int $value): self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        throw new \InvalidArgumentException("Invalid ValueType: $value");
    }
}
