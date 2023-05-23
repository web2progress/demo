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
        Schema::create('indian_all_pincodes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('PostOfficeName', 100)->nullable();
            $table->double('Pincode')->nullable();
            $table->string('City', 100)->nullable();
            $table->string('District', 100)->nullable();
            $table->string('State', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indian_all_pincodes');
    }
};
