<?php

namespace Modules\TomatoCms\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoCms\App\Services\TomatoCmsRegister;
use Modules\TomatoCms\App\Views\MarkdownEditor;
use Modules\TomatoCms\App\Views\MarkdownViewer;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoCmsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoCms';

    protected string $moduleNameLower = 'tomato-cms';

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
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'tomato-cms');

        //Publish Lang
        $this->publishes([
            __DIR__ . '/../resources/lang' => app_path('lang/vendor/tomato-cms'),
        ], 'tomato-cms-lang');


        $menus = [];

        if (config("tomato-cms.features.posts")) {
            $menus[] = Menu::make()
                ->group(__("CMS"))
                ->label(__("Posts"))
                ->icon("bx bx-paperclip")
                ->route("admin.posts.index");
        }

        if (config("tomato-cms.features.pages")) {
            $menus[] = Menu::make()
                ->group(__('CMS'))
                ->label(__('Pages'))
                ->icon('bx bx-file')
                ->route('admin.pages.index');
        }

        if (config("tomato-cms.features.photos")) {
            $menus[] = Menu::make()
                ->group(__('CMS'))
                ->label(__('Photos'))
                ->icon('bx bxs-image')
                ->route('admin.photos.index');
        }

        if (config("tomato-cms.features.services")) {
            $menus[] = Menu::make()
                ->group(__("CMS"))
                ->label(__("Services"))
                ->icon("bx bxl-sketch")
                ->route("admin.services.index");
        }

        if (config("tomato-cms.features.portfolios")) {
            $menus[] = Menu::make()
                ->group(__("CMS"))
                ->label(__("Portfolios"))
                ->icon("bx bxs-hard-hat")
                ->route("admin.portfolios.index");
        }

        if (config("tomato-cms.features.skills")) {
            $menus[] = Menu::make()
                ->group(__("CMS"))
                ->label(__("Skills"))
                ->icon("bx bx-dumbbell")
                ->route("admin.skills.index");
        }

        if (config("tomato-cms.features.testimonials")) {
            $menus[] = Menu::make()
                ->group(__("CMS"))
                ->label(__("Testimonials"))
                ->icon("bx bxs-comment-check")
                ->route("admin.testimonials.index");
        }

        TomatoMenu::register($menus);

        app()->bind('tomato-cms', function () {
            return new TomatoCmsRegister();
        });

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
