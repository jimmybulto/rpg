<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function geMinersCount($user){

        $results = DB::table('users')->where('id', $user)->first();
        $mining =$results->miner;
        if($mining>=0){
            $mining=$mining-1;
            DB::table('users')->where('id', $user)->update(['miner'=> $mining]);
        }

        return $mining;
    }

    public function getRanking(){

        $results = DB::table('users')->orderBy('coins','desc')->get();
        return $results;
    }



    public function geHackerCount($user){

        $results = DB::table('users')->where('id', $user)->first();
        return $results->hacker;
    }

    public function geHouseCount($user){

        $results = DB::table('users')->where('id', $user)->first();
        return $results->house;
    }

    public function getUnits($user){

        $results = DB::table('users')->where('id', $user)->first();
        return $results;
    }

    public function getCurrentCoins($user){

        $results = DB::table('users')->where('id', $user)->first();
        return $results->coins;
    }

    public function getCurrentRocks($user){

        $results = DB::table('users')->where('id', $user)->first();
        return $results->rocks;
    }



    public function mining($user){

        DB::table('users')->where('id', $user)->update(['miner'=> 30]);

    }

    public function resetMining($user){
        DB::table('users')->where('id', $user)->update(['miner'=> -2]);
    }


    public function updateType($type,$val,$user){

        DB::table('users')->where('id', $user)->update([$type=> $val]);

    }
}
