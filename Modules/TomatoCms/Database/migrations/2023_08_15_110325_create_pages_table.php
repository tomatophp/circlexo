<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            //Page Info
            $table->string('color')->nullable();
            $table->json('title');
            $table->json('short_description')->nullable();
            $table->string('slug')->unique()->index();
            $table->json('body')->nullable();

            //Active The Page
            $table->boolean('is_active')->default(true)->nullable();

            //Return to Blade View
            $table->boolean('has_view')->default(false)->nullable();
            $table->string('view')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
