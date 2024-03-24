<?php

namespace Modules\TomatoNotifications\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\TomatoNotifications\App\Console\TomatoNotificationsInstall;
use Modules\TomatoRoles\App\Services\Permission;
use Modules\TomatoRoles\App\Services\TomatoRoles;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoNotificationsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoNotifications';

    protected string $moduleNameLower = 'tomato-notifications';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {

        $this->registerPermissions();

        //Add Middleware Global to Routes web
        TomatoMenu::register([
            Menu::make()
                ->group(__('Notifications'))
                ->label(__('Notifications'))
                ->icon("bx bxs-bell")
                ->route("admin.user-notifications.index"),
            Menu::make()
                ->group(__('Notifications'))
                ->label(__('Templates'))
                ->icon("bx bxs-notification")
                ->route("admin.notifications-templates.index"),

        ]);

        $this->updateConfig();
    }

    /**
     * @return void
     */
    public function registerPermissions(): void
    {
        if(class_exists(TomatoRoles::class)){
            //Register Permission For Settings
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.notifications.index')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.notifications.store')
                ->guard('web')
                ->group('settings')
            );
        }
    }

    public function updateConfig(){
        try {
            Config::set('firebase.projects.app', [
                'credentials' => env('FIREBASE_CREDENTIALS', Str::of(setting('google_firebase_cr'))->replace('https://tomato.test/storage/settings/', base_path('/public/storage/settings/'))->toString()),
                'database' => [
                    'url' => env('FIREBASE_DATABASE_URL', setting('google_firebase_database_url')),
                ]
            ]);
        }
        catch (\Exception $e){
            \Log::error($e);
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        //Register install command
        $this->commands([
            TomatoNotificationsInstall::class
        ]);


        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));


        //Register Langs
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'tomato-notifications');

        //Publish Lang
        $this->publishes([
            __DIR__ . '/../../resources/lang' => base_path('lang/vendor/tomato-notifications'),
        ], 'tomato-notifications-lang');


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
