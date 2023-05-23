<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndianAllPincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indian_all_pincodes', function (Blueprint $table) {
            $table->id();
            $table->string('PostOfficeName');
            $table->double('Pincode');
            $table->string('City');
            $table->string('District');
            $table->string('State');
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
        Schema::dropIfExists('indian_all_pincodes');
    }
}
