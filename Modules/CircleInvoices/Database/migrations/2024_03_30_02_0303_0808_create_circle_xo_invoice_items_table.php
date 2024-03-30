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
        Schema::create('circle_xo_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string("item");
            $table->double("price")->nullable()->unsigned();
            $table->double("discount")->nullable()->unsigned();
            $table->double("tax")->nullable()->unsigned();
            $table->double("qty")->default(1)->nullable()->unsigned();
            $table->double("total")->nullable()->unsigned();
            $table->boolean("is_free")->default(false)->nullable();
            $table->foreignId("invoice_id")->references('id')->on('circle_xo_invoices')->onDelete('cascade');
            $table->string("description")->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_xo_invoice_items');
    }
};
