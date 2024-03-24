<?php

namespace Modules\TomatoRoles\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoRoles\App\Console\TomatoRolesGenerate;
use Modules\TomatoRoles\App\Console\TomatoRolesInstall;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoRolesServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoRoles';

    protected string $moduleNameLower = 'tomato-roles';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'tomato-roles');

        //Register View Component
        $this->loadViewComponentsAs('tomato', [
            \Modules\TomatoRoles\App\Views\Logout::class,
        ]);

        $this->commands([
            TomatoRolesGenerate::class,
            TomatoRolesInstall::class
        ]);


        TomatoMenu::register([
            Menu::make()
                ->group(trans('tomato-roles::global.menu.group'))
                ->label(trans('tomato-roles::global.menu.users'))
                ->icon("bx bxs-user")
                ->route("admin.users.index"),
            Menu::make()
                ->group(trans('tomato-roles::global.menu.group'))
                ->label(trans('tomato-roles::global.menu.roles'))
                ->icon("bx bxs-lock")
                ->route("admin.roles.index")
        ]);

        //Add Middleware Global to Routes web
        $this->app['router']->aliasMiddleware('tomato-roles', \Modules\TomatoRoles\App\Http\Middleware\Can::class);
        $this->app['router']->pushMiddlewareToGroup('web', \Modules\TomatoRoles\App\Http\Middleware\Can::class);

    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower.'.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace').'\\'.$this->moduleName.'\\'.config('modules.paths.generator.component-class.path'));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }
}
