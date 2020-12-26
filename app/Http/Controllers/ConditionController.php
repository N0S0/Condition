<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Condition;
use Carbon\Carbon;
use App\Http\Requests\TodaysCondition;


class ConditionController extends Controller
{
  //
  public function conditions()
  {
    $user = Auth::user();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d');
    $conditions = Condition::all();
    return view('conditions/index',['user'=>$user, 'date'=>$date, 'conditions' => $conditions]);
  }

  public function myPage()
  {
    $user = Auth::user();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d');
    $conditions = Condition::all();
    return view('conditions/myPage',['user'=>$user, 'date'=>$date, 'conditions' => $conditions]);
  }

  public function todaysCondition()
  {
    $user = Auth::user();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d');
    $conditions = Condition::all();
    return view('conditions/todaysCondition',['user'=>$user, 'date'=>$date, 'conditions' => $conditions]);
  }
  
  public function record(Request $request){
    $todaysCondition = new Condition();
    $todaysCondition->date = $request->date;
  }
}
