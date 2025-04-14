<?php

namespace App\Traits;

trait ImageTrait
{
    public function getPrefixPath()
    {
        return config('filesystems.paths.prefix');
    }
}
