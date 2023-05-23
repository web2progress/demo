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
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 115)->unique('pages_page_title_unique');
            $table->string('slug', 115)->unique('pages_page_slug_unique');
            $table->text('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('keyword')->nullable();
            $table->text('description')->nullable();
            $table->string('view')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
