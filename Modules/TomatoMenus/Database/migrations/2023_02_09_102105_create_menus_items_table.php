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
        Schema::create('menus_items', function (Blueprint $table) {
            $table->id();

            //Morph Connector
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('model_type')->nullable();

            //Select Menu
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');

            //Ordering
            $table->integer('order')->default(0);

            //Data
            $table->string('url');
            $table->string('target')->default('_self')->nullable();
            $table->string('name');
            $table->string('bg')->default('#fff')->nullable();
            $table->string('color')->default('#000')->nullable();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('can')->nullable();

            //Sub
            $table->foreignId('parent_id')->nullable()->constrained('menus_items')->onDelete('cascade');

            //Options
            $table->boolean('is_active')->default(1)->nullable();

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
        Schema::dropIfExists('menus_items');
    }
};
