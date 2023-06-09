<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('seo_title', 155)->nullable();
            $table->text('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('keyword')->nullable();
            $table->text('description')->nullable();
            $table->string('tags')->nullable();
            $table->string('categories')->nullable();
            $table->string('view')->nullable();
            $table->string('user_id')->nullable();
            $table->string('modal_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('blog_posts');
    }
};
