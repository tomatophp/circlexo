<?php

namespace Modules\CircleXo\App\Facades;

use Illuminate\Support\Facades\Facade;

class CircleXo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'circle-xo';
    }
}
