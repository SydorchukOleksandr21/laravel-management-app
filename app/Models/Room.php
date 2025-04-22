<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string name
 * @property string notes
 * @property int floor
 * @property int room_sample_id
 *
 * @property RoomSample roomSample
 */
class Room extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
     * @var string[]
     */
    protected $fillable = [
        'floor',
        'number',
        'room_sample_id',
        'notes'
    ];

    /**
     * @return BelongsTo
     */
    public function roomSample(): BelongsTo
    {
        return $this->belongsTo(RoomSample::class);
    }
}
