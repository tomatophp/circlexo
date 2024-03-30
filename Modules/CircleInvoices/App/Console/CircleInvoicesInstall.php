<?php

namespace Modules\CircleInvoices\App\Console;

use Illuminate\Console\Command;
use Modules\CircleApps\App\Models\App;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class CircleInvoicesInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'circle-invoices:install';

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
        $app = App::where('key', 'circle-invoices')->first();
        if(!$app){
            $app = new App();
            $app->key = 'circle-invoices';
            $app->name = 'Circle Invoices';
            $app->description = 'Invoices Generator With Custom Templates, to generate public invoices and your customer can download it';
            $app->is_active = true;
            $app->is_free = true;
            $app->status = "active";
            $app->homepage = "https://www.github.com/tomatophp/circle-invoices";
            $app->github = "https://www.github.com/tomatophp/circle-invoices";
            $app->docs = "https://www.github.com/tomatophp/circle-invoices";
            $app->privacy = "https://www.github.com/tomatophp/circle-invoices";
            $app->faq = "https://www.github.com/tomatophp/circle-invoices";
            $app->email = "info@3x1.io";
            $getContactsApp = App::where('key', 'circle-contacts')->first();
            $app->required = [$getContactsApp->id];
            $app->save();
        }
        $this->callSilent('optimize:clear');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $this->info('Circle Contacts App installed successfully.');
    }
}
