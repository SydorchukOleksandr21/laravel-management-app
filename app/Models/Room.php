<?php

namespace App\Models;

/**
 * @property string name
 * @property string notes
 * @property int floor
 * @property float price
 */
class Room extends AbstractModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rooms';

    protected $fillable = [
        'floor',
        'number',
        'price',
        'notes'
    ];
}
