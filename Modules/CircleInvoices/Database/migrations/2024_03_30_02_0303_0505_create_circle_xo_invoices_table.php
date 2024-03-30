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
        Schema::create('circle_xo_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId("account_id")->references('id')->on('accounts')->onDelete('cascade');
            $table->foreignId("contact_id")->nullable()->references('id')->on('circle_xo_contacts')->onDelete('cascade');
            $table->string("uuid")->unique()->index();
            $table->text("billed_from")->nullable();
            $table->text("billed_to")->nullable();
            $table->text("shipped_to")->nullable();
            $table->date("due_date")->nullable();
            $table->date("invoice_date")->nullable();
            $table->double("paid_amount")->nullable()->unsigned();
            $table->string("payment_method")->default('cash')->nullable();
            $table->json("payment_method_details")->nullable();
            $table->double("total")->nullable()->unsigned();
            $table->double("shipping")->nullable()->unsigned();
            $table->double("discount")->nullable()->unsigned();
            $table->double("tax")->nullable()->unsigned();
            $table->string("type")->default('invoice')->nullable();
            $table->string("status")->default('pending')->nullable();
            $table->string("currency")->default('$')->nullable();
            $table->text("notes")->nullable();
            $table->string("template")->default('main')->nullable();
            $table->boolean('is_public')->default(false)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_xo_invoices');
    }
};
