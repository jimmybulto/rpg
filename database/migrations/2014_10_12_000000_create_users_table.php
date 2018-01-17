<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\constant;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->integer( 'coins');
            $table->integer( 'hp');
            $table->integer( 'atk');
            $table->integer( 'def');
            $table->integer('miner');
            $table->integer('golds');
            $table->integer('rocks');
            $table->rememberToken();
            $table->timestamps();
        });

        $constant = new constant();
        $coins =  $constant->coins;


        $unitsModel = new \App\User();
        $unitsModel->name = "jim";
        $unitsModel->password = "asdf";
        $unitsModel->coins = $coins;
        $unitsModel->atk = 1;
        $unitsModel->hp = 100;
        $unitsModel->def = 1;
        $unitsModel->miner = -2;
        $unitsModel->rocks = 0;
        $unitsModel->golds = 0;
        $unitsModel->save();

        $unitsModel = new \App\User();
        $unitsModel->name = "ryan";
        $unitsModel->password = "asdf";
        $unitsModel->coins = $coins;
        $unitsModel->hp = 100;
        $unitsModel->atk = 1;
        $unitsModel->def = 1;
        $unitsModel->miner = -2;
        $unitsModel->rocks = 0;
        $unitsModel->golds = 0;
        $unitsModel->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
