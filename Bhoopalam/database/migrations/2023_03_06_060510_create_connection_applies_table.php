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
        Schema::create('connection_applies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('application_id');
            $table->string('fullname');
            $table->text('address');
            $table->string('email');
            $table->string('mobileNumber');
            $table->string('altMobileNumber');
            $table->string('pincode');
            $table->string('area');
            $table->string('companyname');
            $table->string('extention');
            $table->string('doorNoAndstreet');
            $table->string('rentalDocument');
            $table->string('panCard');
            $table->string('adharCard');
            $table->string('companyRegistrationDoc');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->timestamps();
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connection_applies');
    }
};
