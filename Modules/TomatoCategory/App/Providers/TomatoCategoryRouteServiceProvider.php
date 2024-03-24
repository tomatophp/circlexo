<?php

namespace Modules\TomatoCategory\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use Modules\TomatoCategory\App\Services\TomatoCategoryHandler;
use Modules\TomatoCategory\App\Services\CategoryServices;


class TomatoCategoryRouteServiceProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function (){
            \Modules\TomatoCategory\App\Services\CategoryServices::loadRoutes();
        });
    }

}
