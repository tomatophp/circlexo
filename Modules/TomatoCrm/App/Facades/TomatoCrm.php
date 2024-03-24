<?php

namespace Modules\TomatoCrm\App\Facades;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Modules\TomatoCrm\App\Models\Account;

/**
 * @method static \Modules\TomatoCrm\App\Services\TomatoCRM create(?string $form = null)
 * @method static \Modules\TomatoCrm\App\Services\TomatoCRM edit(?string $form = null)
 * @method static \Modules\TomatoCrm\App\Services\TomatoCRM show(array $show = [])
 * @method static \Modules\TomatoCrm\App\Services\TomatoCRM table(array $cols = [],?string $view = null)
 * @method static \Modules\TomatoCrm\App\Services\TomatoCRM validation(array $create = [],array $edit = [])
 * @method static \Modules\TomatoCrm\App\Services\TomatoCRM filters(array $filters = [])
 * @method static \Modules\TomatoCrm\App\Services\TomatoCRM media(array $media = [])
 * @method static \Modules\TomatoCrm\App\Services\TomatoCRM attach(string $key,string $label,string $type='text',string|array|null $create_validation=null,string|array|null $update_validation=null, string|array|null $api_create_validation=null,string|array|null $api_update_validation=null,bool $show_on_view = true,bool $show_on_create = true,bool $show_on_edit = true,bool $show_on_table = false,bool $allow_filter = false,)
 * @const string LOGIN_BY_EMAIL
 * @const string LOGIN_BY_PHONE
 * @method void  registerAccountReleation(array $relation)
 * @method array loadRelation()
 */
class TomatoCrm extends Facade
{
    public const LOGIN_BY_EMAIL = 'email';
    public const LOGIN_BY_PHONE = 'phone';

    public static function getFacadeAccessor(): string
    {
        return 'tomato-crm';
    }
}
