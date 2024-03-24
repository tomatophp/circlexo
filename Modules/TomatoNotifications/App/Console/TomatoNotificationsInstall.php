<?php

namespace Modules\TomatoNotifications\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use TomatoPHP\ConsoleHelpers\Traits\HandleStub;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class TomatoNotificationsInstall extends Command
{
    use HandleStub;
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-notifications:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install tomato notifications package and publish assets';

    public function __construct()
    {
        parent::__construct();
        $this->publish = __DIR__ .'/../../publish/';
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('🍅 Publish Components Vendor Assets');
        $this->callSilent('optimize:clear');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $this->info('🍅 Tomato Notifications installed successfully.');
    }
}
