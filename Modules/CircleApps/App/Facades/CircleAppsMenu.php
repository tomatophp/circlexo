<?php

namespace Modules\CircleApps\App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array get()
 * @method static void register(string|array $menus)
 */
class CircleAppsMenu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'circle-apps-menu';
    }
}
