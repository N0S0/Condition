<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Condition;
use App\Condition\IndexDate;
use Carbon\Carbon;
use App\Http\Requests\TodaysCondition;
use Illuminate\Support\Facades\DB;



class ConditionController extends Controller
{
  private $carbon;

  //ログインしていない場合はリダイレクト
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index($id)
  {
    $user = Auth::user();
    if (isset($_GET['prev'])) {
      $data = new IndexDate();
      $month = $data->prevMonth();
    } else if (isset($_GET['next'])) {
      $data = new IndexDate();
      $month = $data->nextMonth();
    } else if (isset($_GET['this']) || empty($_GET)) {
      $data = new IndexDate();
      $month = $data->getMonth();
    } else if (isset($_POST['selectMonth'])) {
      $month = $_POST['selectMonth'];
    }
    $selectMonth = Condition::where('user_id', $id)->select('date')->distinct()->orderBy('date', 'DESC')->get();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d');
    $conditions = Condition::where('user_id', $id)->whereDate('date', 'LIKE', "%{$month}%")->orderBy('date')->get();
    return view('conditions/index', ['user' => $user, 'month' => $month, 'date' => $date, 'conditions' => $conditions, 'selectMonth' => $selectMonth]);
  }

  public function conditions(Request $request)
  {
    $month = $request->selectMonth;
    $conditions = Condition::where('user_id', $request->id)->whereDate('date', 'LIKE', "%{$month}%")->orderBy('date')->get();
    return $conditions;
  }

  public function detailTodaysCondition($id, Request $request)
  {
    $condition_id = $request->condition_id;
    $user = Auth::user();
    $condition = Condition::where('user_id', $id)->where('id', $condition_id)->get();
    return view('conditions/detailTodaysCondition', ['user' => $user, 'condition' => $condition]);
  }

  public function showEdit(int $id, int $condition_id)
  {
    $user = Auth::user($id);
    $condition = Condition::find($condition_id);
    return view('conditions/edit', ['user' => $user, 'condition' => $condition]);
  }

  public function edit(int $id, int $condition_id, Request $request)
  {
    $user = Auth::user($id);
    $condition = Condition::find($condition_id);
    if ($request->has('taion')) {
      $condition->taion = $request->taion;
    } else {
      $condition->taion = '';
    }
    if ($request->has('condition')) {
      $condition->condition = implode(",", $request->condition);
    } else {
      $condition->condition = '';
    }
    if ($request->has('comment')) {
      $condition->comment = $request->comment;
    } else {
      $condition->comment = '';
    }
    $condition->save();
    return redirect()->route('index', ['id' => $user->id]);
  }

  public function delete(int $id, int $condition_id)
  {
    $user = Auth::user($id);
    $condition = Condition::find($condition_id)->delete();
    return redirect()->route('index', ['id' => $user->id]);
  }

  public function myPage()
  {
    $user = Auth::user();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d');
    $conditions = Condition::all();
    return view('conditions/myPage', ['user' => $user, 'date' => $date, 'conditions' => $conditions]);
  }

  public function showTodaysCondition()
  {
    $user = Auth::user();
    return view('conditions/todaysCondition', ['user' => $user]);
  }

  public function record(Request $request)
  {
    $todaysCondition = new Condition();
    $todaysCondition->user_id = Auth::user()->id;
    $todaysCondition->date = $request->date;
    if ($request->has('taion')) {
      $todaysCondition->taion = $request->taion;
    } else {
      $todaysCondition->taion = '';
    }
    if ($request->has('condition')) {
      $todaysCondition->condition = implode(",", $request->condition);
    } else {
      $todaysCondition->condition = '';
    }
    if ($request->has('comment')) {
      $todaysCondition->comment = $request->comment;
    } else {
      $todaysCondition->comment = '';
    }
    $todaysCondition->save();

    return redirect()->route('index', ['id' => $todaysCondition->user_id]);
  }
}
