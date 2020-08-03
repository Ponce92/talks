<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public  function showHome(){
        return view('public.home');
    }

    public  function showLogin(){
        return view('public.login');
    }

    public function login( Request $request){
        return view('home.dash');
    }
}
