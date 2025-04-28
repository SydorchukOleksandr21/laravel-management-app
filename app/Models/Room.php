<?php

namespace App\Models;

use App\Enums\GridValueType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int number
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
        'room_sample_id',
        'number',
        'floor',
        'notes'
    ];

    /**
     * @return BelongsTo
     */
    public function roomSample(): BelongsTo
    {
        return $this->belongsTo(RoomSample::class);
    }

    /**
     * @return array[]
     */
    public function attributeLabels(): array
    {
        return [
            'name' => [
                'name' => 'property.name',
                'type' => GridValueType::String
            ],
            'room_number' => [
                'name' => 'property.room_number',
                'type' => GridValueType::String
            ],
            'floor' => [
                'name' => 'property.floor',
                'type' => GridValueType::String
            ],
            'room_sample_id' => [
                'name' => 'property.room_sample',
                'type' => GridValueType::Link,
                'route' => ('room-sample.show'),
                'object' => "roomSample",
                'property' => "name",
            ],
        ];
    }
}
