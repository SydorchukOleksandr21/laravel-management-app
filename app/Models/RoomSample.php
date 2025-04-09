<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 * @property string name
 * @property int person_count
 * @property int square_area
 * @property string description
 * @property string image_path
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
        'image_path',
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
        return $this->belongsToMany(RoomParameter::class, 'room_sample_room_parameters', 'room_sample_id', 'room_parameter_id');
    }

    /**
     * @return BelongsToMany
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'room', 'room_sample_id', 'id');
    }

    public function getDirectoryPath(): string
    {
        return config('filesystems.paths.roomSamples');
    }

    public function getImagePath(): string
    {
        return $this->getDirectoryPath() . "/$this->image_path";
    }
}
