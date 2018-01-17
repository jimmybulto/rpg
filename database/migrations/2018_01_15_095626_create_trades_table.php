<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('buy');
            $table->integer('sell');
            $table->timestamps();
        });


        $unitsModel = new \App\trades();
        $unitsModel->type = "rocks";
        $unitsModel->buy = 50;
        $unitsModel->sell = 20;
        $unitsModel->save();

        $unitsModel = new \App\trades();
        $unitsModel->type = "golds";
        $unitsModel->buy = 1000;
        $unitsModel->sell = 500;
        $unitsModel->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trades');
    }
}
