<?php

namespace Modules\TomatoTranslations\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoRoles\App\Services\Permission;
use Modules\TomatoRoles\App\Services\TomatoRoles;
use Modules\TomatoTranslations\App\Views\Translation;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoTranslationsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoTranslations';

    protected string $moduleNameLower = 'tomato-translations';

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
        $this->registerPermissions();

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'tomato-translations');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../../resources/lang' => resource_path('lang/vendor/tomato-translations'),
        ], 'tomato-translations-lang');

        $this->commands([
            \Modules\TomatoTranslations\App\Console\TomatoTranslationsInstall::class,
        ]);


        $this->loadViewComponentsAs('tomato', [
            Translation::class
        ]);

        if(config('tomato-translations.allow_gui')) {
            TomatoMenu::register([
                Menu::make()
                    ->group(__('Tools'))
                    ->label(trans('tomato-translations::global.title'))
                    ->icon("bx bx-globe")
                    ->route("admin.translations.index"),
            ]);
        }
    }

    private function registerPermissions(): void
    {
        if(class_exists(TomatoRoles::class)) {
            TomatoRoles::register(Permission::make()
                ->name('admin.translations.index')
                ->guard('web')
                ->group('translations')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.translations.scan')
                ->guard('web')
                ->group('translations')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.translations.export')
                ->guard('web')
                ->group('translations')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.translations.importView')
                ->guard('web')
                ->group('translations')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.translations.import')
                ->guard('web')
                ->group('translations')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.translations.auto')
                ->guard('web')
                ->group('translations')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.translations.edit')
                ->guard('web')
                ->group('translations')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.translations.update')
                ->guard('web')
                ->group('translations')
            );

            TomatoRoles::register(Permission::make()
                ->name('admin.translations.destroy')
                ->guard('web')
                ->group('translations')
            );
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();
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
