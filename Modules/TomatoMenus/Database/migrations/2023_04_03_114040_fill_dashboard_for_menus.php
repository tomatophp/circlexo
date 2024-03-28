<?php

use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FillDashboardForMenus extends Migration
{
    /**
     * @var Repository|mixed
     */
    protected $guardName;
    /**
     * @var array
     */
    protected $permissions;
    /**
     * @var array
     */
    protected $roles;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::transaction(function () {
            $menu = DB::table('menus')->where([
                'name' => json_encode(["ar" => "Dashboard", "en" => "Dashboard"]),
                'key' => "dashboard",
            ])->first();
            if ($menu === null) {
                DB::table('menus')->insert([
                    'name' => json_encode(["ar" => "Dashboard", "en" => "Dashboard"]),
                    'key' => "dashboard",
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::transaction(function (){
            $permissionItem = DB::table('menus')->where([
                'name' => json_encode(["ar" => "Dashboard", "en" => "Dashboard"]),
                'key' => "dashboard",
            ])->first();
            if ($permissionItem !== null) {
                DB::table('menus')->where('id', $permissionItem->id)->delete();
            }
        });
    }
}
