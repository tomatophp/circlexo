<?php

namespace Modules\TomatoCrm\App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Botble\Base\Supports\Action
 */
class ActionFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'core-action';
    }
}
