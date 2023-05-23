<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarrifPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarrif_plans', function (Blueprint $table) {
            $table->id();
            $table->string('statname');
            $table->string('oprtype');
            $table->string('oprname');
            $table->string('plantype');
            $table->float('amount');
            $table->double('oldamt');
            $table->string('vdays');
            $table->tinyText('description');
            $table->integer('slno');
            $table->string('boxtype');
            $table->string('orn');
            $table->enum('status',['active','inactive'])->default('inactive');
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
        Schema::dropIfExists('tarrif_plans');

    }
}
