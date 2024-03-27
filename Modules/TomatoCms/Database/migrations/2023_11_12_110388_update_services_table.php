<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('features');
            $table->dropColumn('process');
            $table->dropColumn('body');

            $table->foreignId('page_id')->nullable()->constrained('pages')->onDelete('cascade');
            $table->foreignId('form_id')->nullable()->constrained('forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('features');
            $table->dropColumn('process');
            $table->dropColumn('body');
        });
    }
};
