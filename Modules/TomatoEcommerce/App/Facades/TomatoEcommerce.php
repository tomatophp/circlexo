<?php

namespace Modules\TomatoEcommerce\App\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\TomatoEcommerce\App\Models\Cart;

/**
 * @method static \Modules\TomatoEcommerce\App\Services\Ecommerce setCart(\Modules\TomatoEcommerce\App\Models\Cart $cart)
 * @method static Cart store(\Illuminate\Http\Request $request)
 */
class TomatoEcommerce extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tomato-ecommerce';
    }
}
