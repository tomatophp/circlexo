<?php

namespace Modules\CircleApps\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\CircleApps\App\Facades\CircleApps;
use Modules\CircleApps\App\Facades\CircleAppsMenu;
use Spatie\Permission\Models\Role;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu as TomatoMenuFacade;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoAdmin\Services\TomatoMenu;

class CircleAppsServices
{
    /**
     * @return array
     */
    public function menus(): array
    {
        return CircleAppsMenu::get();
    }
}
