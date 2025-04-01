<?php

namespace App\Traits;

/**
 * @method getTable()
 */
trait StaticTableName
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return with(new static)->getTable();
    }
}
