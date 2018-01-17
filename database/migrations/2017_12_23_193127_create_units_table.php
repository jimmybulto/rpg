<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\constant;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user');
            $table->integer( 'coins');
            $table->integer( 'atk');
            $table->integer( 'def');
            $table->string('name');
            $table->integer('miner');
            $table->integer('golds');
            $table->integer('rocks');
            $table->timestamps();
        });

        $constant = new constant();
        $coins =  $constant->coins;


        $unitsModel = new \App\units();
        $unitsModel->name = "jim";
        $unitsModel->coins = $coins;
        $unitsModel->atk = 1;
        $unitsModel->def = 1;
        $unitsModel->miner = -2;
        $unitsModel->rocks = 0;
        $unitsModel->golds = 0;
        $unitsModel->user=1;
        $unitsModel->save();

        $unitsModel = new \App\units();
        $unitsModel->name = "jay";
        $unitsModel->atk = 1;
        $unitsModel->def = 1;
        $unitsModel->coins = $coins;
        $unitsModel->miner = -2;
        $unitsModel->rocks = 0;
        $unitsModel->golds = 0;
        $unitsModel->user=2;
        $unitsModel->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('units');
    }
}
