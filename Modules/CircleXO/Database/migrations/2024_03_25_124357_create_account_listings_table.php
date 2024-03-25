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
        Schema::create('account_listings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();

            $table->string('type')->default('link')->nullable();
            $table->string('title')->index();
            $table->longText('body')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->string('description')->nullable();
            $table->integer('order')->default(0)->nullable();
            $table->boolean('is_active')->default(true)->nullable();

            $table->double('price')->unsigned()->default(0)->nullable();
            $table->double('discount')->unsigned()->default(0)->nullable();

            $table->double('rating')->default(0)->nullable();

            $table->double('views')->default(0)->nullable();
            $table->double('likes')->default(0)->nullable();
            $table->double('share')->default(0)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_listings');
    }
};
