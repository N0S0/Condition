<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
    return view('welcome',['user' => $user]);
    }
}
