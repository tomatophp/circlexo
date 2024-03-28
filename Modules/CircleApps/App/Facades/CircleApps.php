<?php

namespace Modules\CircleApps\App\Facades;

use Illuminate\Support\Facades\Facade;

class CircleApps extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'circle-apps';
    }
}
