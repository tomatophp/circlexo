<?php

namespace Modules\TomatoCrm\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoCategory\App\Facades\TomatoCategory;
use Modules\TomatoCategory\App\Services\Contracts\Type;
use Modules\TomatoCrm\App\Console\TomatoCrmInstall;
use Modules\TomatoCrm\App\Events\SendOTP;
use Modules\TomatoCrm\App\Services\BuildAuth;
use Modules\TomatoCrm\App\Services\TomatoCRM;
use Modules\TomatoCrm\App\Supports\Action;
use Modules\TomatoCrm\App\Supports\Filter;
use Modules\TomatoNotifications\App\Services\SendNotification;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoCrmServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoCrm';

    protected string $moduleNameLower = 'tomato-crm';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $menus = [];
        if (config('tomato-crm.features.accounts')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Accounts'))
                ->route('admin.accounts.index')
                ->icon('bx bxs-user');
        }
        if (config('tomato-crm.features.requests')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Account Requests'))
                ->route('admin.account-requests.index')
                ->icon('bx bxs-user-circle');
        }
        if (config('tomato-crm.features.contacts')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Contact Us'))
                ->route('admin.contacts.index')
                ->icon('bx bxs-phone');
        }
        if (config('tomato-crm.features.notifications')) {
            $menus[] = Menu::make()
                ->group(__('CRM'))
                ->label(__('Send Notification'))
                ->route('admin.accounts.notifications.index')
                ->icon('bx bxs-bell');
        }


        if (config('tomato-crm.features.send_otp')) {
            Event::listen([
                SendOTP::class
            ], function ($data) {
                $user = $data->model::find($data->modelId);

                SendNotification::make(['email'])
                    ->title('OTP')
                    ->message('Your OTP is ' . $user->otp_code)
                    ->type('info')
                    ->database(false)
                    ->model(config('tomato-crm.model'))
                    ->id($user->id)
                    ->privacy('private')
                    ->icon('bx bx-user')
                    ->url(url('/'))
                    ->fire();
            });
        }

        TomatoMenu::register($menus);

        TomatoCategory::register([
            Type::make()
                ->label(__('Account Types'))
                ->for('accounts')
                ->type('type')
                ->back('admin.accounts.index')
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->commands([
            TomatoCrmInstall::class
        ]);

        $this->registerConfig();
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));

        //Publish Model
        $this->publishes([
            __DIR__ . '/../../publish/Account.php' => app_path('Models/Account.php'),
        ], 'tomato-crm-model');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'tomato-crm');

        //Publish Lang
        $this->publishes([
            __DIR__ . '/../../resources/lang' => app_path('lang/vendor/tomato-crm'),
        ], 'tomato-crm-lang');

        $this->registerConfig();
        $this->app->register(RouteServiceProvider::class);


        $this->app->bind('tomato-auth', function () {
            return new BuildAuth();
        });

        $this->app->bind('tomato-crm', function () {
            return new TomatoCRM();
        });


        $this->app->singleton('core-action', function () {
            return new Action();
        });

        $this->app->singleton('core-filter', function () {
            return new Filter();
        });
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
