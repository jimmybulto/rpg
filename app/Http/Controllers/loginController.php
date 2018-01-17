<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class loginController extends Controller
{
    public function login(){

//        $users=array('id'=>1,'password'=>'asdf');
//        if (Auth::attempt($users)) {
////            return "a";
        $user = User::find(1);
        Auth::login($user);
            return Redirect::to('/');
//        }else{
//            return Redirect::to('error');
//        }

    }

    public function welcome(){
        return view('welcome');
    }

    public function error(){
        Auth::logout();
        return view('error');
    }
}