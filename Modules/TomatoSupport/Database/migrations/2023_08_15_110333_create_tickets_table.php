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
        if(config('tomato-support.features.tickets')) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();

                //Add Status For Tickets
                $table->foreignId('type_id')->nullable()->constrained('types')->onDelete('cascade');

                //Link User To Ticket With Morph
                $table->morphs('accountable');
                $table->string('name')->nullable();
                $table->string('phone')->nullable();

                //Add User For Tickets
                $table->string('subject');
                $table->string('code')->unique()->index();
                $table->longText('message')->nullable();

                //Get Last update time
                $table->timestamp('last_update')->nullable();

                //Is closed
                $table->boolean('is_closed')->default(false)->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
