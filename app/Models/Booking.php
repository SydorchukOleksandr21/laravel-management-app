<?php

namespace App\Models;

use App\Enums\GridValueType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property integer $room_id
 * @property integer $guest_id
 * @property integer $pin_code
 * @property Carbon $date_start
 * @property Carbon $date_end
 * @property float $price
 * @property bool $is_paid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Booking extends Model
{
    use HasFactory;

    /**
     * @var string The table associated with the model.
     */
    protected $table = 'bookings';

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'room_id',
        'guest_id',
        'pin_code',
        'date_start',
        'date_end',
        'price',
        'is_paid',
    ];

    /**
     * @var array The attributes that should be cast to native types.
     */
    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
        'is_paid' => 'boolean',
    ];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * Get the room associated with the booking.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the guest associated with the booking.
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * @return array[]
     */
    public function attributeLabels(): array
    {
        return [
            'room_id' => [
                'name' => 'property.booking.room_id',
                'type' => GridValueType::Link,
                'route' => ('room.show'),
                'object' => "room",
                'property' => "number",
            ],
            'guest_id' => [
                'name' => 'property.booking.guest_id',
                'type' => GridValueType::Link,
                'route' => ('guest.show'),
                'object' => "guest",
                'property' => "name",
            ],
            'pin_code' => [
                'name' => 'property.booking.pin_code',
                'type' => GridValueType::String,
            ],
            'date_start' => [
                'name' => 'property.booking.date_start',
                'type' => GridValueType::Date
            ],
            'date_end' => [
                'name' => 'property.booking.date_end',
                'type' => GridValueType::Date
            ],
            'price' => [
                'name' => 'property.booking.price',
                'type' => GridValueType::Currency
            ],
            'is_paid' => [
                'name' => 'property.booking.is_paid',
                'type' => GridValueType::Checkbox
            ],
        ];
    }
}
