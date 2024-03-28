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
        Schema::create('account_has_apps', function (Blueprint $table) {
            $table->foreignId("account_id")->references('id')->on('accounts')->onDelete('cascade');
            $table->foreignId("app_id")->references('id')->on('apps')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_has_apps');
    }
};
