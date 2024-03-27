<?php

namespace Modules\TomatoCms\App\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\TomatoCms\App\Services\Page;
use Modules\TomatoCms\App\Services\Section;


/**
 * @method static registerPage(Page $page)
 * @method array getPages()
 * @method void build()
 */
class TomatoCMS extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'tomato-cms';
    }
}
