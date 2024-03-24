<?php

namespace Modules\TomatoLocations\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoLocations\App\Views\Location;
use Modules\TomatoRoles\App\Services\Permission;
use Modules\TomatoRoles\App\Services\TomatoRoles;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoLocationsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoLocations';

    protected string $moduleNameLower = 'tomato-locations';

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


        //Register Langs
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'tomato-locations');

        //Publish Lang
        $this->publishes([
            __DIR__ . '/../../resources/lang' => app_path('lang/vendor/tomato-locations'),
        ], 'tomato-locations-lang');

        $this->loadViewComponentsAs('tomato', [
            Location::class
        ]);

        TomatoMenu::register([
                Menu::make()
                    ->group(__('Locations'))
                    ->label(trans('tomato-locations::global.country.title'))
                    ->icon("bx bxs-flag")
                    ->route("admin.countries.index"),
                Menu::make()
                    ->group(__('Locations'))
                    ->label(trans('tomato-locations::global.city.title'))
                    ->icon("bx bxs-city")
                    ->route("admin.cities.index"),
                Menu::make()
                    ->group(__('Locations'))
                    ->label(trans('tomato-locations::global.area.title'))
                    ->icon("bx bxs-map")
                    ->route("admin.areas.index"),
                Menu::make()
                    ->group(__('Locations'))
                    ->label(trans('tomato-locations::global.language.title'))
                    ->icon("bx bx-globe")
                    ->route("admin.languages.index"),
                Menu::make()
                    ->group(__('Locations'))
                    ->label(trans('tomato-locations::global.currency.title'))
                    ->icon("bx bx-money")
                    ->route("admin.currencies.index"),
                Menu::make()
                    ->group(__('Locations'))
                    ->label(trans('tomato-locations::global.settings.title'))
                    ->icon("bx bxs-cog")
                    ->route("admin.settings.locations.index")
            ]
        );

        //Register Permission For Settings
        TomatoRoles::register(Permission::make()
            ->name('admin.settings.locations.index')
            ->guard('web')
            ->group('settings')
        );
        TomatoRoles::register(Permission::make()
            ->name('admin.settings.locations.store')
            ->guard('web')
            ->group('settings')
        );
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
