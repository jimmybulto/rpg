<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;


class statsController extends Controller
{
    public function getStats()
    {

//        $user=Auth::user()->id;
        $user=\Illuminate\Support\Facades\Input::get("user");
        $unitModel = new User();
        $units = new unitsController();
        //$miners = $unitModel->geMinersCount($user);
        $unit_counts = $unitModel->getUnits($user);
        $coins = $unit_counts->coins;
       // $coins = $units->updateCoins($miners, $coins, $user);

        $rocks = $unit_counts->rocks;
        $name = $unit_counts->name;
        $golds = $unit_counts->golds;
        $atk = $unit_counts->atk;
        $def = $unit_counts->def;
        $hp = $unit_counts->hp;
        $miners= $unit_counts->miner;
        $ranking = $unitModel->getRanking();
        $message = null;

        if ($miners == -1) {
            $message = $units->getMineRewards($user);
        }

        $data = array(
            'id'=>$user,
            'coins' =>$coins ,
            'hp'=>$hp,
            'name' =>$name ,
            'miner' => $miners,
            'rocks' => $rocks,
            'golds' => $golds,
            'atk' => $atk,
            'def' => $def,
            'ranking' => $ranking,
            'message' => $message
        );
        return $data;
    }


}
