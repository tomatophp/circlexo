<?php

namespace Modules\CircleXo\App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array get()
 * @method static void profileSlider()
 * @method static void headerMenu()
 * @method static void sideMenu()
 * @method static void profileFilterSlider()
 * @method static void profileButtons()
 * @method static void profileDropdown()
 * @method static void register(string|array $menus)
 */
class CircleXoSlots extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'circle-xo-slots';
    }
}
