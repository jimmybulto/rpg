<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;


class combatController extends Controller
{
    public function attack()
    {

//        $user=Auth::user()->id;
        $user=\Illuminate\Support\Facades\Input::get("user");
        $def=\Illuminate\Support\Facades\Input::get("defender");
        $unitModel = new User();
        $units = new unitsController();

        $def_counts = $unitModel->getUnits($def);
        $user_counts = $unitModel->getUnits($user);

        $def = $def_counts->def;
        $atk = $user_counts->atk;

        $message = "hello";

        return $message;
    }


}
