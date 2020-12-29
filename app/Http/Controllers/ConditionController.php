<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Condition;
use Carbon\Carbon;
use App\Http\Requests\TodaysCondition;


class ConditionController extends Controller
{
  //ログインしていない場合はリダイレクト
  public function __construct(){
    $this->middleware('auth');
  }

  public function conditions()
  {
    $user = Auth::user();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d');
    $conditions = Condition::all();
    return view('conditions/index',['user'=>$user, 'date'=>$date, 'conditions' => $conditions]);
  }

  public function showEdit(int $id,int $condition_id){
    $user = Auth::user($id);
    $condition = Condition::find($condition_id);
    return view('conditions/edit',['user'=>$user,'condition' => $condition]);
  }

  public function edit(){

  }

  public function myPage()
  {
    $user = Auth::user();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d');
    $conditions = Condition::all();
    return view('conditions/myPage',['user'=>$user, 'date'=>$date, 'conditions' => $conditions]);
  }

  public function showTodaysCondition()
  {
    $user = Auth::user();
    return view('conditions/todaysCondition',['user'=>$user]);
  }
  
  public function record(Request $request){
    $todaysCondition = new Condition();
    $todaysCondition->user_id = Auth::user()->id;
    $todaysCondition->date = $request->date;
    $todaysCondition->taion = $request->taion;
    $todaysCondition->condition = implode(",", $request->condition);
    $todaysCondition->comment = $request->comment;
    $todaysCondition->save();

    return redirect()->route('index',['id'=>$todaysCondition->user_id]);
  }
}
