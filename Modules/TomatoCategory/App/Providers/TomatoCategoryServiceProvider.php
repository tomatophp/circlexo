<?php

namespace Modules\TomatoCategory\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoCategory\App\Services\TomatoCategoryHandler;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoCategoryServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoCategory';

    protected string $moduleNameLower = 'tomato-category';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-category');

        //Register generate command
        $this->commands([
            \Modules\TomatoCategory\App\Console\TomatoCategoriesInstall::class,
        ]);

        //Publish Lang
        $this->publishes([
            __DIR__.'/../resources/lang' => app_path('lang/vendor/tomato-category'),
        ], 'tomato-category-lang');


        $menus = [];

        if(config("tomato-category.features.category")){
            $menus[] = Menu::make()
                ->group(__("Category"))
                ->label(__("Categories"))
                ->icon("bx bxs-category")
                ->route("admin.categories.index");
        }
        if(config("tomato-category.features.types")){
            $menus[] = Menu::make()
                ->group(__("Category"))
                ->label(__("Types"))
                ->icon("bx bxs-check-circle")
                ->route("admin.types.index");
        }

        TomatoMenu::register($menus);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();

        $this->app->bind('tomato-category', function () {
            return new TomatoCategoryHandler();
        });

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(TomatoCategoryRouteServiceProvider::class);
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
