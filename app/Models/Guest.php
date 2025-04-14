<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string phone_number
 * @property string email
 */
class Guest extends Model
{
    /**
     * @var string
     */
    protected $table = 'guests';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
    ];
}
