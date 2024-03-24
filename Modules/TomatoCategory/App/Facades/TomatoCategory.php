<?php

namespace Modules\TomatoCategory\App\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\TomatoCategory\App\Services\Contracts\Type;


/**
 *  @method static \Illuminate\Support\Collection get()
 * @method static \Illuminate\Support\Collection load()
 * @method static \Modules\TomatoCategory\App\Contracts\Type register(array|Type $item)
 */
class TomatoCategory extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tomato-category';
    }
}
