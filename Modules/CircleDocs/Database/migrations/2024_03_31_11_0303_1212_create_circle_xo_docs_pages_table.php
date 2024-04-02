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
        Schema::create('circle_xo_docs_pages', function (Blueprint $table) {
            $table->id();
            $table->string("title")->index();
            $table->string("description")->nullable();
            $table->longText("body");
            $table->bigInteger("parent_id")->nullable()->unsigned();
            $table->string("icon")->nullable();
            $table->string("color")->nullable();
            $table->string("slug")->nullable()->index();
            $table->foreignId("doc_id")->references('id')->on('circle_xo_docs')->onDelete('cascade');
            $table->string("group")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_xo_docs_pages');
    }
};
