<?php

namespace Modules\TomatoThemes\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoThemes\App\Facades\TomatoThemes;
use Modules\TomatoThemes\App\Services\Theme;
use Modules\TomatoThemes\App\Views\BuilderToolbar;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;

include __DIR__.'/helpers.php';

class TomatoThemesServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoThemes';

    protected string $moduleNameLower = 'tomato-themes';

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
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'tomato-themes');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../../resources/lang' => base_path('lang/vendor/tomato-themes'),
        ], 'tomato-themes-lang');

        TomatoMenu::register([
            Menu::make()
                ->group(__('Themes'))
                ->label(trans('tomato-themes::messages.title'))
                ->icon("bx bxs-brush")
                ->route("admin.themes.index"),
            Menu::make()
                ->group(__('Themes'))
                ->label(__('Features'))
                ->icon('bx bx-list-check')
                ->route('admin.features.index')
        ]);

        TomatoThemes::loadSections();

    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();

        if(File::exists(base_path('Themes'))){
            $activeTheme = false;
            $themes = File::directories(base_path('Themes'));
            if (count($themes)){
                foreach($themes as $theme){
                    $themeInfo = json_decode(File::get($theme.'/info.json'), false);
                    if($themeInfo->active){
                        $activeTheme = $themeInfo->name;
                        break;
                    }
                }
                if($activeTheme){
                    $themeRoutes = base_path('Themes') .'/'.$activeTheme.'/routes/web.php';
                    $this->loadRoutesFrom($themeRoutes);

                    //Register views
                    $this->loadViewsFrom(base_path('Themes') .'/'.$activeTheme, 'themes');
                }
            }
        }

        app()->bind('tomato-themes', function(){
            return new Theme();
        });

        $this->loadViewComponentsAs('tomato', [
            BuilderToolbar::class
        ]);

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
