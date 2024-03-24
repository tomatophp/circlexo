<?php

namespace Modules\TomatoSettings\App\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\TomatoSettings\App\Services\Contracts\SettingHold;

/**
 *  @method static \Illuminate\Support\Collection get()
 * @method static \Illuminate\Support\Collection load()
 * @method static \Modules\TomatoSettings\App\Services\SettingHolderHandler register(array|SettingHold $item)
 */
class TomatoSettings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tomato-settings';
    }
}
