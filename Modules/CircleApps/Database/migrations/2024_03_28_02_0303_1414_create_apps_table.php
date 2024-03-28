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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->foreignId("account_id")->nullable()->references('id')->on('accounts');
            $table->string("name")->index();
            $table->string("description")->nullable();
            $table->string("key")->unique()->index();
            $table->longText("readme")->nullable();
            $table->string("homepage")->nullable();
            $table->string("email")->nullable();
            $table->string("docs")->nullable();
            $table->string("github")->nullable();
            $table->string("privacy")->nullable();
            $table->string("faq")->nullable();
            $table->string("status")->default('pending')->nullable();
            $table->boolean("is_active")->default(false)->nullable();
            $table->double("price")->nullable()->unsigned();
            $table->string("price_per")->default('month')->nullable();
            $table->double("discount")->nullable()->unsigned();
            $table->datetime("discount_to")->nullable();
            $table->boolean("is_free")->default(true)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
