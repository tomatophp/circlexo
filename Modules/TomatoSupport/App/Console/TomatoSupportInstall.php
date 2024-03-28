<?php

namespace Modules\TomatoSupport\App\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class TomatoSupportInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-support:install';

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
        $this->info('DB Seed');
        $typeArray = [
            [
                "for" => "tickets",
                "type" => "status",
                "name" => json_encode([
                    "ar" => "تحت المراجعة",
                    "en" => "Pending"
                ]),
                "key" => "pending",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "for" => "tickets",
                "type" => "status",
                "name" => json_encode([
                    "ar" => "تم الرد عن طريق الدعم",
                    "en" => "Againt Response"
                ]),
                "key" => "againt-response",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "for" => "tickets",
                "type" => "status",
                "name" => json_encode([
                    "ar" => "تم الرد عن طريق العميل",
                    "en" => "Customer Response"
                ]),
                "key" => "customer-response",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "for" => "tickets",
                "type" => "status",
                "name" => json_encode([
                    "ar" => "مغلقة",
                    "en" => "Closed"
                ]),
                "key" => "closed",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "for" => "faq",
                "type" => "category",
                "name" => json_encode([
                    "ar" => "عام",
                    "en" => "General"
                ]),
                "key" => "general",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ];
        foreach ($typeArray as $type){
            $checkExists = DB::table('types')
                ->where('key', $type['key'])->first();
            if(!$checkExists){
                DB::table('types')->insert($type);
            }
        }
        $this->info('Publish Vendor Assets');
        $this->callSilent('optimize:clear');
        $this->info('Tomato Support installed successfully.');
    }
}
