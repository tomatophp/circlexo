<?php

namespace Modules\CircleXO\App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array get()
 * @method static static profileSlider()
 * @method static static headerMenu()
 * @method static static sideMenu()
 * @method static static profileFilterSlider()
 * @method static static profileButtons()
 * @method static static profileDropdown()
 * @method static static register(string|array $menus)
 */
class CircleXoSlots extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'circle-xo-slots';
    }
}
