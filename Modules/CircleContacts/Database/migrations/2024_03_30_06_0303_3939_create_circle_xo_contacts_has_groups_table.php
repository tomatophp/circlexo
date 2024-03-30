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
        Schema::create('circle_xo_contacts_has_groups', function (Blueprint $table) {
            $table->foreignId("contact_id")->references('id')->on('circle_xo_contacts')->primary();
            $table->foreignId("group_id")->references('id')->on('circle_xo_contacts_groups');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_xo_contacts_has_groups');
    }
};
