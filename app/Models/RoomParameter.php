<?php

namespace App\Models;

use App\Enums\ValueType;
use App\Traits\StaticTableName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomParameter extends AbstractModel
{
    use HasFactory;

    protected $table = 'room_parameters';

    protected $fillable = [
        'name',
        'value_type',
        'value',
    ];

    protected $casts = [
        'value_type' => 'integer',
    ];

    /**
     * Get value_type as a ValueType enum.
     */
    public function getValueTypeAttribute(): ValueType
    {
        return ValueType::fromInt($this->attributes['value_type']);
    }

    /**
     * Set value_type from a ValueType enum.
     */
    public function setValueTypeAttribute(ValueType $type): void
    {
        $this->attributes['value_type'] = $type->value;
    }
}
