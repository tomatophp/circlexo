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
        Schema::create('circle_xo_docs_pages_metas', function (Blueprint $table) {
            $table->id();
            $table->string("key")->index();
            $table->json("value")->nullable();
            $table->string("type")->default('text')->nullable();
            $table->foreignId("docs_page_id")->references('id')->on('circle_xo_docs_pages')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circle_xo_docs_pages_metas');
    }
};
