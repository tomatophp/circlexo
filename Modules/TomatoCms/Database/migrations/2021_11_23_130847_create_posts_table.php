<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            //Ref
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');

            $table->string('type')->default('post');

            //Info
            $table->string('title');
            $table->string('slug')->unique()->nullable();

            $table->text('short_description');
            $table->text('keywords')->nullable();

            $table->longText('body');

            //Options
            $table->boolean('activated')->default(0);
            $table->boolean('trend')->default(0);
            $table->date('published_at')->nullable();

            //Counters
            $table->double('likes')->default(0);
            $table->double('views')->default(0);

            //Meta
            $table->string('meta_url')->nullable();
            $table->json('meta')->nullable();
            $table->text('meta_redirect')->nullable();

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
        Schema::dropIfExists('posts');
    }
}
