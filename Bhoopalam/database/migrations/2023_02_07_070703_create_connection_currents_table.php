<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionCurrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_currents', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id')->length('111')->unsigned();
            $table->integer('user_id')->lenght('111')->unsigned();
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
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('connection_currents');
    }
}
