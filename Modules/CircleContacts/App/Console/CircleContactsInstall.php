<?php

namespace Modules\CircleContacts\App\Console;

use Illuminate\Console\Command;
use Modules\CircleApps\App\Models\App;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class CircleContactsInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'circle-contacts:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install package and publish assets';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Install App');
        $app = App::where('key', 'circle-contacts')->first();
        if(!$app){
            $app = new App();
            $app->key = 'circle-contacts';
            $app->name = 'Circle Contacts';
            $app->description = 'Manage your contacts and customers from your profile';
            $app->is_active = true;
            $app->is_free = true;
            $app->status = "active";
            $app->homepage = "https://www.github.com/tomatophp/circle-contacts";
            $app->github = "https://www.github.com/tomatophp/circle-contacts";
            $app->docs = "https://www.github.com/tomatophp/circle-contacts";
            $app->privacy = "https://www.github.com/tomatophp/circle-contacts";
            $app->faq = "https://www.github.com/tomatophp/circle-contacts";
            $app->email = "info@3x1.io";
            $app->save();
        }
        $this->callSilent('optimize:clear');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $this->info('Circle Contacts App installed successfully.');
    }
}
