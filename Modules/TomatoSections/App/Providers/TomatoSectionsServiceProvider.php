<?php

namespace Modules\TomatoSections\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoThemes\App\Facades\TomatoThemes;
use Modules\TomatoSections\App\Sections\TomatoAboutFeaturesSection;
use Modules\TomatoSections\App\Sections\TomatoBlogIndex;
use Modules\TomatoSections\App\Sections\TomatoBlogSection;
use Modules\TomatoSections\App\Sections\TomatoCategorySection;
use Modules\TomatoSections\App\Sections\TomatoContactUsSection;
use Modules\TomatoSections\App\Sections\TomatoFAQSection;
use Modules\TomatoSections\App\Sections\TomatoFeatureSection;
use Modules\TomatoSections\App\Sections\TomatoFooterSection;
use Modules\TomatoSections\App\Sections\TomatoHeaderSection;
use Modules\TomatoSections\App\Sections\TomatoHeroSection;
use Modules\TomatoSections\App\Sections\TomatoPageBodySection;
use Modules\TomatoSections\App\Sections\TomatoPageTitleSection;
use Modules\TomatoSections\App\Sections\TomatoPortfolioIndex;
use Modules\TomatoSections\App\Sections\TomatoPortfolioSection;
use Modules\TomatoSections\App\Sections\TomatoProductsSection;
use Modules\TomatoSections\App\Sections\TomatoServicesSection;
use Modules\TomatoSections\App\Sections\TomatoShopSection;
use Modules\TomatoSections\App\Sections\TomatoSkillsSection;
use Modules\TomatoSections\App\Sections\TomatoTestimonialsSection;

class TomatoSectionsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoSections';

    protected string $moduleNameLower = 'tomato-sections';

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

        TomatoThemes::registerSection(new TomatoAboutFeaturesSection());
        TomatoThemes::registerSection(new TomatoBlogSection());
        TomatoThemes::registerSection(new TomatoCategorySection());
        TomatoThemes::registerSection(new TomatoContactUsSection());
        TomatoThemes::registerSection(new TomatoFAQSection());
        TomatoThemes::registerSection(new TomatoFeatureSection());
        TomatoThemes::registerSection(new TomatoFooterSection());
        TomatoThemes::registerSection(new TomatoHeaderSection());
        TomatoThemes::registerSection(new TomatoHeroSection());
        TomatoThemes::registerSection(new TomatoPageBodySection());
        TomatoThemes::registerSection(new TomatoPageTitleSection());
        TomatoThemes::registerSection(new TomatoPortfolioSection());
        TomatoThemes::registerSection(new TomatoProductsSection());
        TomatoThemes::registerSection(new TomatoShopSection());
        TomatoThemes::registerSection(new TomatoPortfolioIndex());
        TomatoThemes::registerSection(new TomatoSkillsSection());
        TomatoThemes::registerSection(new TomatoTestimonialsSection());
        TomatoThemes::registerSection(new TomatoServicesSection());
        TomatoThemes::registerSection(new TomatoBlogIndex());
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
