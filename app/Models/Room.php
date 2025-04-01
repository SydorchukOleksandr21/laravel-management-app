<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'notes'
    ];
}
