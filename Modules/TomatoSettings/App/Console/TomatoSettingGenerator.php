<?php

namespace Modules\TomatoSettings\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\HandleStub;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class TomatoSettingGenerator extends Command
{
    use HandleStub;
    use RunCommand;

    private string $stubPath;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato:setting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'build a new settings page';

    public function __construct()
    {
        parent::__construct();
        $this->stubPath = __DIR__ .'/../../stubs/';
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $settingName = $this->ask('🍅 Please input your setting page name? (ex: Sites)');



        //Check if user need to use HMVC
        $isModule=$this->ask('🍅 Do you went to use HMVC module? (y/n)');
        $moduleName= false;
        if($isModule === 'y'){
            $moduleName=$this->ask('🍅 Please input your module name? (ex: Translations)');
            if($moduleName){
                if(class_exists(\Nwidart\Modules\Facades\Module::class)){
                    $check = \Nwidart\Modules\Facades\Module::find($moduleName);
                    $this->info("🍅 Module not found but we will create it for you ");
                    if(!$check){
                        $this->artisanCommand(["module:make", $moduleName]);
                    }
                }
                else {
                    $this->error("🍅 Sorry nwidart/laravel-modules not installed please install it first");
                }
            }
        }

        /*
         * Generate Setting Class
         */
        $settingClass = Str::ucfirst(Str::camel(Str::replace('_', ' ', $settingName))) . 'Settings';
        $group = Str::lower($settingName);
        $this->generateStubs(
            $this->stubPath . '/SettingsClass.stub',
            $moduleName ? module_path($moduleName) . "/Settings/". $settingClass . '.php' : app_path('/Settings/' . $settingClass . '.php'),
            [
                'name' => $settingClass,
                'namespace' => $moduleName ? "Modules\\" . $moduleName."\\Settings" : "App\\Settings",
                'group' => $group
            ],
            [
                $moduleName ? module_path($moduleName) . "/Settings/" : app_path('/Settings/')
            ]
        );
        $this->info('🍅 Setting Class Has Been Generated Success');

        /*
         * Generate Setting Migration
         */
        $this->generateStubs(
            $this->stubPath . '/SettingsMigration.stub',
            $moduleName ? module_path($moduleName) . "/Database/migrations/" . date('Y_m_d_His').'_'. $group . '_settings.php' : database_path('migrations/'. date('Y_m_d_His').'_'. $group . '_settings.php'),
            [
                'name' => $settingClass.'Migration',
                'group' => $group
            ]
        );
        $this->info('🍅 Setting Migrations Has Been Generated Success');

        /*
         * Generate Setting Request
         */
        $requestClass = $settingClass.'Request';
        $this->generateStubs(
            $this->stubPath . '/SettingRequest.stub',
            $moduleName ? module_path($moduleName) .  '/Http/Requests/Settings/' . $requestClass .'.php': app_path('Http/Requests/Settings/' . $requestClass .'.php'),
            [
                'namespace' => $moduleName ? "Modules\\" . $moduleName . "\\Http\\Requests\\Settings"  :"App\\Http\\Requests\\Settings",
                'name' => $requestClass,
                'group' => $group
            ],
            [
                $moduleName ? module_path($moduleName) . '/Http/Requests/Settings/' : app_path('Http/Requests/Settings/')
            ]
        );
        $this->info('🍅 Setting Request Has Been Generated Success');

        /*
         * Generate Setting Controller
         */
        $controllerClass = $settingClass.'Controller';
        $this->generateStubs(
            $this->stubPath . '/SettingsController.stub',
            $moduleName ? module_path($moduleName) . '/Http/Controllers/Settings/' . $controllerClass .'.php' : app_path('Http/Controllers/Settings/' . $controllerClass .'.php'),
            [
                'moduleName' => $moduleName ? Str::replace('_', '-',Str::snake($moduleName)) ."::" : "admin.",
                'namespace' => $moduleName ? "Modules\\" . $moduleName . "\\Http\\Controllers\\Settings" : "App\\Http\\Controllers\\Settings",
                'name' => $controllerClass,
                'group' => $group,
                'settingClass' => $moduleName ? "\\Modules\\" . $moduleName . "\\Settings\\" .$settingClass: '\\App\\Settings\\'.$settingClass,
                'settingRequest' => $moduleName ? "\\Modules\\" . $moduleName . "\\Http\\Requests\\Settings\\".$requestClass : '\\App\\Http\\Requests\\Settings\\'.$requestClass
            ],
            [
                $moduleName ? module_path($moduleName) . '/Http/Controllers/Settings/' : app_path('Http/Controllers/Settings/')
            ]
        );
        $this->info('🍅 Setting Controllers Has Been Generated Success');


        /*
         * Generate Setting Views
         */
        $this->generateStubs(
            $this->stubPath . '/SettingView.stub',
            $moduleName ? module_path($moduleName) . '/Resources/views/settings/' . $group .'.blade.php': resource_path('views/admin/settings/' . $group .'.blade.php'),
            [
                'name' => Str::ucfirst(Str::camel($group)) . " Settings",
                'group' => $group
            ],
            [
                $moduleName ? module_path($moduleName) . '/Resources/views/settings/' : resource_path('views/admin/settings/')
            ]
        );
        $this->info('🍅 Setting Views Has Been Generated Success');

        /*
         * Generate Setting Routes
         */
        $this->generateStubs(
            $this->stubPath . '/SettingRoutes.stub',
            $moduleName ? module_path($moduleName) ."/Routes/web.php" :base_path('routes/web.php'),
            [
                'name' => $moduleName ? "\\Modules\\". $moduleName . "\\Http\\Controllers\\Settings\\".$controllerClass : '\\App\\Http\\Controllers\\Settings\\'.$controllerClass,
                'group' => $group
            ],
            [
                $moduleName ? module_path($moduleName) ."/Routes" : base_path('routes')
            ],
            true
        );

        $this->info('🍅 Setting Routes Has Been Generated Success');

        /*
         * Generate Setting Menu
         */
        $menuClass = $settingClass . 'Menu';
        $this->generateStubs(
            $this->stubPath . "SettingsMenu.stub",
            $moduleName ? module_path($moduleName) . "/Menus/".$menuClass.".php" : app_path("Menus/".$menuClass.".php"),
            [
                "name" => $menuClass,
                "namespace" => $moduleName ? "Modules\\" . $moduleName . "\\Menus" : "App\\Menus",
                "table" => $group,
                "index" => "admin.settings.". $group . ".index"
            ],
            [
                $moduleName ?  module_path($moduleName) . "/Menus" : app_path("Menus")
            ]
        );
    }
}
