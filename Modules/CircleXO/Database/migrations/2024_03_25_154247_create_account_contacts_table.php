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
        Schema::create('account_contacts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->foreignId('sender_id')->nullable()->constrained('accounts')->onDelete('cascade');

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('message');

            $table->boolean('anonymous_message')->default(0)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_contacts');
    }
};
