<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
  //ログインしていない場合はリダイレクト
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function show(Request $request)
  {
    $user = Auth::user();
    if ($request->has('month')) {
      $date = $request->month;
      $date = date($date . '-01');
    } else {
      $date = time();
    }

    $calendar = new CalendarView($date);
    return view('conditions/calendar', ['user' => $user, 'calendar' => $calendar]);
  }
}
