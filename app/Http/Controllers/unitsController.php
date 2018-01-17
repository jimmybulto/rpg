<?php

namespace App\Http\Controllers;

use App\trades;
use App\units;
use App\User;
use ClassPreloader\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\coins;
use App\constant;

class unitsController extends Controller
{

    protected  $rocks;
    protected  $golds;

    public function __construct()
    {
      $constant = new constant();
        $this->rocks =  $constant->rocks;
        $this->golds =  $constant->golds;
    }

    public function updateCoins($miner, $coins, $user)
    {
        $unitsModel = new User();
        $coins++;
        $unitsModel->updateType('coins',$coins, $user);

        return $coins;
    }

    public function levelUp()
    {
        $user = \Illuminate\Support\Facades\Input::get("user");
        $type = \Illuminate\Support\Facades\Input::get("type");
        $unitsModel = new User();
        $units = $unitsModel->getUnits($user);
        $stats = $units->$type;
        $rocks = $units->rocks;
        $golds = $units->golds;
        $req_rock = ($stats%10)*20;
        $req_gold =floor(($stats/10)*2);


        if($rocks>=$req_rock && $golds>=$req_gold){
            $unitsModel->updateType('rocks',$rocks - $req_rock, $user);
            $unitsModel->updateType('golds',$golds-$req_gold, $user);
            $stats++;
            $unitsModel->updateType($type,$stats, $user);
        }


        //return $coins;
    }

    public function getMineRewards($user)
    {
        $unitModel = new User();
        $units = $unitModel->getUnits($user);
        $rock = $units->rocks;
        $gold = $units->golds;
        $chance = rand(1, 100) / 100;

        $reward_rocks = $this->rocks * $chance;
        $reward_golds = $this->golds * $chance;
        $unitModel->updateType('rocks',floor($reward_rocks) + $rock, $user);
        $unitModel->updateType('golds',floor($reward_golds) + $gold, $user);

        $unitModel->resetMining($user);
        return floor($reward_rocks) . " rock received. " . floor($reward_golds) . " gold received.";
    }

    public function mine()
    {
        $user = \Illuminate\Support\Facades\Input::get("user");
        $unitModel = new User();
        $coins = $unitModel->getCurrentCoins($user);

        if ($coins >= 100) {
            $unitModel->updateType('coins',$coins - 100, $user);
            $unitModel->mining($user);
        }
    }

    public function buy()
    {
        $unitModel = new User();
        $user = \Illuminate\Support\Facades\Input::get("user");
        $type = \Illuminate\Support\Facades\Input::get("type");
        $qty = \Illuminate\Support\Facades\Input::get("qty");
        $trade = new trades();
        $coins = $unitModel->getCurrentCoins($user);
        $cost = $trade->getBuy($type)*$qty;
        $units = $unitModel->getUnits($user);
        $rock = $units->$type;
        if ($coins >= $cost) {
            $unitModel->updateType('coins',$coins - $cost, $user);
            $unitModel->updateType($type,$rock+$qty,$user);
        }
    }

    public function sell()
    {
        $unitModel = new User();
        $user = \Illuminate\Support\Facades\Input::get("user");
        $type = \Illuminate\Support\Facades\Input::get("type");
        $qty = \Illuminate\Support\Facades\Input::get("qty");
        $trade = new trades();
        $coins = $unitModel->getCurrentCoins($user);
        $cost = $trade->getSell($type)*$qty;
        $units = $unitModel->getUnits($user);
        $rock = $units->$type;

        if($rock>=$qty){
            $unitModel->updateType('coins',$coins + $cost, $user);
            $unitModel->updateType($type,$rock-$qty,$user);
        }
    }

}
