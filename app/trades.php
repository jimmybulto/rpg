<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class trades extends Model
{
    //

    public function getBuy($type){

        $results = DB::table('trades')->where('type', $type)->first();
        return $results->buy;
    }

    public function getSell($type){

        $results = DB::table('trades')->where('type', $type)->first();
        return $results->sell;
    }
}
