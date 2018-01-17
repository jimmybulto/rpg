<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class units extends Model
{
    //
    public function geMinersCount($user){

        $results = DB::table('units')->where('user', $user)->first();
        $mining =$results->miner;
        if($mining>=0){
            $mining=$mining-1;
            DB::table('units')->where('user', $user)->update(['miner'=> $mining]);
        }

        return $mining;
    }

    public function getRanking(){

      $results = DB::table('units')->orderBy('coins','desc')->get();
        return $results;
    }



    public function geHackerCount($user){

        $results = DB::table('units')->where('user', $user)->first();
        return $results->hacker;
    }

    public function geHouseCount($user){

        $results = DB::table('units')->where('user', $user)->first();
        return $results->house;
    }

    public function getUnits($user){

        $results = DB::table('units')->where('user', $user)->first();
        return $results;
    }

    public function getCurrentCoins($user){

        $results = DB::table('units')->where('user', $user)->first();
        return $results->coins;
    }

    public function getCurrentRocks($user){

        $results = DB::table('units')->where('user', $user)->first();
        return $results->rocks;
    }



    public function mining($user){

        DB::table('units')->where('user', $user)->update(['miner'=> 30]);

    }

    public function resetMining($user){

        DB::table('units')->where('user', $user)->update(['miner'=> -2]);

    }

    public function addHouse($user){

        DB::table('units')->where('user', $user)->update(['house'=> $this->geHouseCount($user)+1]);

    }

    public function addHacker($user){

        DB::table('units')->where('user', $user)->update(['hacker'=> $this->geHackerCount($user)+1]);

    }

//    public function updateCoins($coins,$user){
//
//        DB::table('units')->where('user', $user)->update(['coins'=> $coins]);
//
//    }
//
//    public function updateRocks($rocks,$user){
//
//        DB::table('units')->where('user', $user)->update(['rocks'=> $rocks]);
//
//    }

    public function updateType($type,$val,$user){

        DB::table('units')->where('user', $user)->update([$type=> $val]);

    }


}
