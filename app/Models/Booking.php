<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
}
