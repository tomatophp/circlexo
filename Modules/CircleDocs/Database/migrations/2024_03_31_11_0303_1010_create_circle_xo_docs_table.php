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
        Schema::create('circle_xo_docs', function (Blueprint $table) {
            $table->id();
            $table->string("name")->index();
            $table->string("package")->unique()->index();
            $table->text("about")->nullable();
            $table->string("repository")->nullable();
            $table->string("branch")->nullable();
            $table->longText("readme")->nullable();
            $table->boolean("is_active")->default(false)->nullable();
            $table->boolean("is_public")->default(false)->nullable();
            $table->foreignId("account_id")->references('id')->on('accounts')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_xo_docs');
    }
};
