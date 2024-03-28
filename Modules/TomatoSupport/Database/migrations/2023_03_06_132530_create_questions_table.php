<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(config('tomato-support.features.faq')){
            Schema::create('questions', function (Blueprint $table) {
                $table->id();

                //QA Category
                $table->foreignId('type_id')->nullable()->constrained('types')->onDelete('cascade');

                //QA / Answer
                $table->json('qa');
                $table->json('answer')->nullable();

                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
