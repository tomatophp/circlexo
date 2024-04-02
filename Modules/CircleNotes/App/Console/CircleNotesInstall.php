<?php

namespace Modules\CircleNotes\App\Console;

use Illuminate\Console\Command;
use Modules\CircleApps\App\Models\App;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class CircleNotesInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'circle-notes:install';

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
        $app = App::where('key', 'circle-notes')->first();
        if(!$app){
            $app = new App();
            $app->key = 'circle-notes';
            $app->name = 'Circle Notes';
            $app->description = 'Capture Notes, organize tasks and ideas easily';
            $app->is_active = true;
            $app->is_free = true;
            $app->status = "active";
            $app->homepage = "https://www.github.com/tomatophp/circle-notes";
            $app->github = "https://www.github.com/tomatophp/circle-notes";
            $app->docs = "https://www.github.com/tomatophp/ccircle-notes";
            $app->privacy = "https://www.github.com/tomatophp/circle-notes";
            $app->faq = "https://www.github.com/tomatophp/circle-notes";
            $app->email = "AbdelmjidDev@gmail.com";
            $app->save();
        }
        $this->callSilent('optimize:clear');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $this->info('Circle Contacts App installed successfully.');
    }
}
