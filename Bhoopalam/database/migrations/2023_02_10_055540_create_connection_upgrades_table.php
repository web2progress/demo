<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionUpgradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_upgrades', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id')->length('111')->unsigned();
            $table->integer('user_id')->length('111')->unsigned();
            $table->string('fullname');
            $table->string('mobileNumber');
            $table->string('companyname');
            $table->text('address');
            $table->string('altMobileNumber');
            $table->string('request_doc');
            $table->string('application');
            $table->enum('status',['active','inactive','pending'])->default('pending');
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
        Schema::dropIfExists('connection_upgrades');
    }
}
