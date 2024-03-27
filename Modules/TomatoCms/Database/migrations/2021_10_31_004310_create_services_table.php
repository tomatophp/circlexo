<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            //About
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->string('sku')->unique()->nullable();
            $table->double('rate')->default(0);

            //Features
            $table->string('short_description')->nullable();
            $table->string('keywords')->nullable();
            $table->longText('features')->nullable();
            $table->longText('process')->nullable();
            $table->longText('body')->nullable();

            //Options
            $table->boolean('activated')->default(0);
            $table->boolean('trend')->default(0);
            $table->double('views')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
