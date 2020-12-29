<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
  //
  public function show(){
    $user = Auth::user();
    $calendar = new CalendarView(time());
    return view('conditions/calendar',['user'=>$user,'calendar'=>$calendar]);
  }
}
