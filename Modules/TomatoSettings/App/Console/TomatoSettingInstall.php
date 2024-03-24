<?php

namespace Modules\TomatoSettings\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\HandleFiles;
use TomatoPHP\ConsoleHelpers\Traits\HandleStub;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class TomatoSettingInstall extends Command
{
    use HandleStub;
    use RunCommand;
    use HandleFiles;

    private string $stubPath;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-settings:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install tomato settings package and publish assets';

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
        $this->info('🍅 Publish Settings Vendor Assets');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $this->info('🍅 Tomato Settings installed successfully.');
    }
}
