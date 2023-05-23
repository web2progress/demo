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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_title');
            $table->string('product_slug');
            $table->string('product_cat')->nullable();
            $table->string('product_amount')->nullable();
            $table->string('product_mrp')->nullable();
            $table->string('product_offer')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('product_img')->nullable();
            $table->string('meta_title', 50)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_tags')->nullable();
            $table->text('product_short_description')->nullable();
            $table->text('product_full_description')->nullable();
            $table->string('product_view')->nullable();
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
        Schema::dropIfExists('products');
    }
};
