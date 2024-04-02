<?php

namespace Modules\CircleApps\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\CircleApps\App\Facades\CircleXo;
use Spatie\Permission\Models\Role;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu as TomatoMenuFacade;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoAdmin\Services\TomatoMenu;

class CircleAppsMenuServices
{
    private Collection $menu;

    public function __construct()
    {
        $this->menu = new Collection();
    }

    /**
     * @param string|array $menus
     * @return void
     */
    public function register(string|array $menus): void
    {
        if(is_array($menus)) {
            foreach ($menus as $menu)
            $this->menu->push($menu);
        } else {
            $this->menu->push($menus);
        }
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->menu->toArray();
    }
}
