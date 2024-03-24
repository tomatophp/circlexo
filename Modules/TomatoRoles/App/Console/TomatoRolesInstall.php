<?php

namespace Modules\TomatoRoles\App\Console;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use TomatoPHP\ConsoleHelpers\Traits\HandleFiles;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use Modules\TomatoRoles\App\Services\Generator\CRUDGenerator;
use Modules\TomatoRoles\App\Services\GenerateRoles;

class TomatoRolesInstall extends Command
{
    use RunCommand;
    use HandleFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-roles:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install tomato roles packages and publish the assets';

    public function __construct()
    {
        parent::__construct();
        $this->publish = __DIR__ . "/../../publish";
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->info('🍅 Publish Roles Vendor Assets');
        $this->handelFile('/config/permission.php', config_path('/permission.php'));
        $this->callSilent('config:cache');
        $this->artisanCommand(['tomato-components:install']);
        $this->callSilent('optimize:clear');
        $this->callSilent('migrate');
        $this->yarnCommand(['build']);
        $mainAccount = User::where('email', 'admin@admin.com')->first();
        if(!$mainAccount){
            $mainAccount = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password')
            ]);

            $role = Role::where('name', 'admin')->first();
            $mainAccount->roles()->sync([$role->id]);
        }
        else {
            $role = Role::where('name', 'admin')->first();
            $mainAccount->roles()->sync([$role->id]);
        }
        $this->info('🍅 Try to login /admin/login with user "admin@admin.com" and password "password"');
        $this->info('🍅 Tomato Roles installed successfully.');
    }
}
