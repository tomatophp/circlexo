<?php

namespace Modules\CircleDocs\App\Console;

use Illuminate\Console\Command;
use Modules\CircleApps\App\Models\App;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class CircleDocsInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'circle-docs:install';

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
        $app = App::where('key', 'circle-docs')->first();
        if(!$app){
            $app = new App();
            $app->key = 'circle-docs';
            $app->name = 'Circle Docs';
            $app->description = 'Create and share, search in your docs using markdown editor and GitHub integration';
            $app->is_active = true;
            $app->is_free = true;
            $app->status = "active";
            $app->homepage = "https://www.github.com/tomatophp/circle-docs";
            $app->github = "https://www.github.com/tomatophp/circle-docs";
            $app->docs = "https://www.github.com/tomatophp/circle-docs";
            $app->privacy = "https://www.github.com/tomatophp/circle-docs";
            $app->faq = "https://www.github.com/tomatophp/circle-docs";
            $app->email = "info@3x1.io";
            $app->save();
        }
        $this->callSilent('optimize:clear');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $this->info('Circle Contacts App installed successfully.');
    }
}
