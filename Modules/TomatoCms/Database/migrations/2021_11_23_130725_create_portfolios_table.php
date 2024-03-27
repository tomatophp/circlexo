<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            //Refs
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');

            //Info
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->text('keywords')->nullable();

            //Customer
            $table->string('company')->nullable();

            //Dates
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            //Body
            $table->longText('body')->nullable();

            //Options
            $table->boolean('activated')->default(0);
            $table->double('views')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
