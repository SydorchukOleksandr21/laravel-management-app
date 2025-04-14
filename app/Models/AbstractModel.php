<?php

namespace App\Models;

use App\Traits\StaticTableName;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    use StaticTableName;
}
