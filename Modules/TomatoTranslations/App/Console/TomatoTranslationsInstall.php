<?php

namespace Modules\TomatoTranslations\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use TomatoPHP\ConsoleHelpers\Traits\HandleFiles;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class TomatoTranslationsInstall extends Command
{
    use RunCommand;
    use HandleFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-translations:install';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install package and publish assets';

    public function __construct()
    {
        $this->publish =base_path( "Modules/TomatoTranslations/publish/");
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Publish Vendor Assets');
        $this->callSilent('optimize:clear');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        if(!File::exists(base_path('lang'))){
            File::makeDirectory(base_path('lang'));
        }
        $this->handelFile('lang/ar.json', lang_path('ar.json'));
        $this->handelFile('lang/en.json', lang_path('en.json'));
        $this->info('Tomato Translations installed successfully.');
    }
}
