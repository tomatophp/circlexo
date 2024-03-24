<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Nwidart\Modules\Facades\Module;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $countires = \Illuminate\Support\Facades\File::get(base_path('Modules/TomatoLocations/Database/data/countries.sql'));
        DB::connection()->getPdo()->exec($countires);

        $citites = \Illuminate\Support\Facades\File::get(base_path('Modules/TomatoLocations/Database/data/cities.sql'));
        DB::connection()->getPdo()->exec($citites);

        $areas = \Illuminate\Support\Facades\File::get(base_path('Modules/TomatoLocations/Database/data/areas.sql'));
        DB::connection()->getPdo()->exec($areas);

        $currencies = \Illuminate\Support\Facades\File::get(base_path('Modules/TomatoLocations/Database/data/currencies.sql'));
        DB::connection()->getPdo()->exec($currencies);

        $languages = \Illuminate\Support\Facades\File::get(base_path('Modules/TomatoLocations/Database/data/languages.sql'));
        DB::connection()->getPdo()->exec($languages);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
