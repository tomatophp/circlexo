<?php

namespace Modules\CircleXO\App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoThemes\App\Facades\TomatoThemes;

class CircleXOServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'CircleXO';

    protected string $moduleNameLower = 'circle-xo';

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
        $this->registerComponents();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function registerComponents(): void
    {
        $this->loadViewComponentsAs($this->moduleNameLower, [
            \Modules\CircleXO\App\View\Components\AppLayout::class,
            \Modules\CircleXO\App\View\Components\ProfileLayout::class,
            \Modules\CircleXO\App\View\Components\PublicProfileLayout::class,
            \Modules\CircleXO\App\View\Components\Header::class,
            \Modules\CircleXO\App\View\Components\Features::class,
            \Modules\CircleXO\App\View\Components\Footer::class,
            \Modules\CircleXO\App\View\Components\Hero::class,
            \Modules\CircleXO\App\View\Components\Button::class,
            \Modules\CircleXO\App\View\Components\Card::class,
            \Modules\CircleXO\App\View\Components\ProfileCard::class,
            \Modules\CircleXO\App\View\Components\Logo::class,
            \Modules\CircleXO\App\View\Components\Listing::class,
            \Modules\CircleXO\App\View\Components\ListingCard::class,
            \Modules\CircleXO\App\View\Components\ListingFilters::class,
            \Modules\CircleXO\App\View\Components\ListingFilterItem::class,
            \Modules\CircleXO\App\View\Components\SocialItem::class,
            \Modules\CircleXO\App\View\Components\SocialLinks::class,
            \Modules\CircleXO\App\View\Components\ProfileAvatar::class,
            \Modules\CircleXO\App\View\Components\ProfileCover::class,
            \Modules\CircleXO\App\View\Components\ProfileButtons::class,
            \Modules\CircleXO\App\View\Components\ProfileSide::class,
            \Modules\CircleXO\App\View\Components\ProfileInfo::class,
            \Modules\CircleXO\App\View\Components\ListingType::class,
            \Modules\CircleXO\App\View\Components\Recap::class,
            \Modules\CircleXO\App\View\Components\Share::class,
            \Modules\CircleXO\App\View\Components\MenuItems::class,
        ]);


        TomatoThemes::registerSection(new \Modules\CircleXO\App\Sections\CircleXOHeader());
        TomatoThemes::registerSection(new \Modules\CircleXO\App\Sections\CircleXOFooter());
        TomatoThemes::registerSection(new \Modules\CircleXO\App\Sections\CircleXOFAQ());
        TomatoThemes::registerSection(new \Modules\CircleXO\App\Sections\CircleXOPageTitle());
        TomatoThemes::registerSection(new \Modules\CircleXO\App\Sections\CircleXOPageBody());
        TomatoThemes::registerSection(new \Modules\CircleXO\App\Sections\CircleXOHero());
        TomatoThemes::registerSection(new \Modules\CircleXO\App\Sections\CircleXOFeatures());
        TomatoThemes::registerSection(new \Modules\CircleXO\App\Sections\CircleXOListing());
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
