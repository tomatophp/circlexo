<?php

namespace Modules\TomatoSettings\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoRoles\App\Services\Permission;
use Modules\TomatoRoles\App\Services\TomatoRoles;
use Modules\TomatoSettings\App\Console\TomatoSettingGenerator;
use Modules\TomatoSettings\App\Console\TomatoSettingInstall;
use Modules\TomatoSettings\App\Facades\TomatoSettings;
use Modules\TomatoSettings\App\Services\Contracts\SettingHold;
use Modules\TomatoSettings\App\Services\SettingHolderHandler;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoSettingsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoSettings';

    protected string $moduleNameLower = 'tomato-settings';

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

        //Publish Lang
        $this->publishes([
            __DIR__.'/../resources/lang' => app_path('lang/vendor/tomato-settings'),
        ], 'tomato-settings-lang');

        //Publish Migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tomato-settings-migrations');

        //Register generate command
        $this->commands([
            TomatoSettingInstall::class,
            TomatoSettingGenerator::class,
        ]);

        //Register new blade component
        $this->loadViewComponentsAs('tomato-settings', [
            \Modules\TomatoSettings\App\Views\Card::class,
        ]);

        $this->registerPermissions();

        TomatoMenu::register([
            Menu::make()
                ->group(__('Settings'))
                ->label(__('Settings'))
                ->icon("bx bxs-cog")
                ->route("admin.settings.index")
        ]);

        app()->bind('tomato-settings', function () {
            return new SettingHolderHandler();
        });


        TomatoSettings::register([
            SettingHold::make()
                ->label(__('SEO Settings'))
                ->icon('bx bx-search')
                ->route('admin.settings.seo.index')
                ->description(__('Name, Logo, Site Profile'))
                ->group(__('General')),
            SettingHold::make()
                ->label(__('Interface Settings'))
                ->icon('bx bx-globe')
                ->route('admin.settings.site.index')
                ->description(__('Site Menu, Site Social Media links, etc.'))
                ->group(__('General')),
            SettingHold::make()
                ->label(__('Location Settings'))
                ->icon('bx bx-map')
                ->route('admin.settings.local.index')
                ->description(__('Contacts, Country, Language, Currency, etc.'))
                ->group(__('General')),
            SettingHold::make()
                ->label(__('Email SMTP Services'))
                ->icon('bx bx-envelope')
                ->route('admin.settings.email.index')
                ->description(__('SMTP, Sender, etc.'))
                ->group(__('Services')),
            SettingHold::make()
                ->label(__('Google Services'))
                ->icon('bx bxl-google')
                ->color('#e43e2a')
                ->route('admin.settings.google.index')
                ->description(__('Google API Key, Google Cloud Key, etc.'))
                ->group(__('Services')),
            SettingHold::make()
                ->label(__('Google Firebase'))
                ->color('#feca2c')
                ->icon('bx bxl-firebase')
                ->route('admin.settings.google-firebase.index')
                ->description(__('Google Firebase JSON, Google Cloud Messaging.'))
                ->group(__('Services')),
            SettingHold::make()
                ->label(__('Google reCAPTCHA'))
                ->icon('https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/RecaptchaLogo.svg/2048px-RecaptchaLogo.svg.png')
                ->route('admin.settings.google-recap.index')
                ->description(__('Google reCAPTCHA Key, etc.'))
                ->group(__('Services')),
            SettingHold::make()
                ->label(__('Payment Gateway'))
                ->icon('bx bx-credit-card')
                ->route('admin.settings.payments.index')
                ->description(__('Active Payment Gate, Select Default one, etc.'))
                ->group(__('Services')),
            SettingHold::make()
                ->label(__('Facebook Services'))
                ->color('#0169e4')
                ->icon('bx bxl-meta')
                ->route('admin.settings.services-facebook.index')
                ->description(__('Meta Pixcel, Facebook Chat Box, Facebook App, etc.'))
                ->group(__('Services')),
            SettingHold::make()
                ->label(__('AddThis Services'))
                ->icon('https://upload.wikimedia.org/wikipedia/commons/1/1d/AddThis_logo.png')
                ->route('admin.settings.services-addthis.index')
                ->description(__('Link addThis with API, etc.'))
                ->group(__('Services')),
            SettingHold::make()
                ->label(__('SMS Gates Services'))
                ->icon('bx bxs-megaphone')
                ->route('admin.settings.services-sms.index')
                ->description(__('Link any SMS gate with API,MessageBird, Twilo etc.'))
                ->group(__('Services')),
            SettingHold::make()
                ->label(__('Shipping Gates Services'))
                ->icon('bx bxs-truck')
                ->route('admin.settings.services-shipping.index')
                ->description(__('Link shipping gateway with API,DHL, Posta etc.'))
                ->group(__('Services'))
        ]);


        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'tomato-settings');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../../resources/lang' => app_path('lang/vendor/tomato-settings'),
        ], 'tomato-settings-lang');
    }

    /**
     * @return void
     */
    public function registerPermissions(): void
    {
        if(class_exists(TomatoRoles::class)){
            //Register Permission For Settings
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.site.index')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.site.store')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.email.index')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.email.store')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.google.index')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.google.store')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.services.index')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.services.store')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.themes.index')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.themes.store')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.payments.index')
                ->guard('web')
                ->group('settings')
            );
            TomatoRoles::register(Permission::make()
                ->name('admin.settings.payments.store')
                ->guard('web')
                ->group('settings')
            );
        }
    }



    public function registerSettingsConfigPass(): void
    {
        try {
            Config::set('mail.mailers.smtp', [
                'transport' => setting('mail_mailer'),
                'host' => setting('mail_host'),
                'port' => setting('mail_port'),
                'encryption' => setting('mail_encryption'),
                'username' => setting('mail_username'),
                'password' => setting('mail_password'),
                'timeout' => null,
                'auth_mode' => null,
            ]);

            Config::set('mail.from', [
                'address' => setting('mail_from_address'),
                'name' => setting('mail_from_name'),
            ]);

        } catch (\Exception $e) {
            \Log::error($e);
        }
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
