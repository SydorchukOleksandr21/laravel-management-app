<?php

namespace App\Enums;

enum ValueType: int
{
    case Number = 0;
    case String = 1;

    /**
     * Get a human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Number => 'Number',
            self::String => 'String',
        };
    }

    /**
     * Convert integer to ValueType.
     */
    public static function fromInt(int $value): self
    {
        return match ($value) {
            0 => self::Number,
            1 => self::String,
            default => throw new \InvalidArgumentException("Invalid ValueType: $value"),
        };
    }
}
