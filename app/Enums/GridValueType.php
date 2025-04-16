<?php

namespace App\Enums;

enum GridValueType: int
{
    case String = 1;
    case Checkbox = 2;
    case Image = 4;
    case Currency = 5;

    /**
     * Get a human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::String => 'String',
            self::Checkbox => 'Checkbox',
            self::Image => 'Image',
            self::Currency => 'Currency',
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
