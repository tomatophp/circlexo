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
        Schema::create('circle_xo_contacts_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId("account_id")->references('id')->on('accounts')->onDelete('cascade');
            $table->string("name")->unique()->index();
            $table->text("description");
            $table->string("icon")->nullable();
            $table->string("color")->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_xo_contacts_groups');
    }
};
