<?php

namespace Modules\TomatoCms\App\Console;

use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use Modules\TomatoCategory\App\Models\Type;

class TomatoCmsInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-cms:install';

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
        $this->info('Publish Vendor Assets');
        $this->callSilent('optimize:clear');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $arrayOfTypes = [
            [
                "name" => [
                    "ar" => "المقالات",
                    "en" => "Posts"
                ],
                "key" => "post",
                "for" => "posts",
                "type" => "type"
            ],
            [
                "name" => [
                    "ar" => "معلومة",
                    "en" => "Info"
                ],
                "key" => "info",
                "for" => "posts",
                "type" => "type"
            ],
            [
                "name" => [
                    "ar" => "مفتوح المصدر",
                    "en" => "Open Source"
                ],
                "key" => "open-source",
                "for" => "posts",
                "type" => "type"
            ],
            [
                "name" => [
                    "ar" => "فيديوهات",
                    "en" => "Videos"
                ],
                "key" => "videos",
                "for" => "posts",
                "type" => "type"
            ]
        ];
        foreach ($arrayOfTypes as $type){
            if(!Type::where('key', $type['key'])->first()){
                Type::create($type);
            }
        }
        $this->info('Tomato CMS installed successfully.');
    }
}
