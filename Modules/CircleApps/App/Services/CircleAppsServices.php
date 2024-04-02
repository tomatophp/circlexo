<?php

namespace Modules\CircleApps\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\CircleApps\App\Facades\CircleAppsMenu;
use Modules\CircleApps\App\Facades\CircleXo;
use Modules\CircleApps\App\Facades\CircleXoSlots;
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
