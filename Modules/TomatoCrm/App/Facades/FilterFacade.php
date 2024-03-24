<?php

namespace Modules\TomatoCrm\App\Facades;

use Illuminate\Support\Facades\Facade;

class FilterFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'core-filter';
    }
}
