<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string name
 * @property int person_count
 * @property int square_area
 * @property string description
 */
class RoomSample extends AbstractModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'room_samples';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'person_count',
        'square_area',
        'description',
    ];

    /**
     * @var string[]
     */
    protected $attributes = [
        'description' => '',
    ];

    /**
     * @return BelongsToMany
     */
    public function roomParameters(): BelongsToMany
    {
        return $this->belongsToMany(RoomParameter::class, 'room_parameter_room_sample', 'room_sample_id', 'room_parameter_id');
    }

    /**
     * @return BelongsToMany
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room', 'room_sample_id', 'id');
    }
}
