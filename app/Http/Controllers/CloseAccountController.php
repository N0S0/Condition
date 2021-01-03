<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class CloseAccountController extends Controller
{
  //
  //ログインしていない場合はリダイレクト
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function account()
  {
    $user = Auth::user();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d');
    return view('conditions/closeAccount',['user'=>$user, 'date'=>$date]);
  }

  //ユーザー削除(投稿も)
  public function delete(){
    $user = Auth::user();
    Auth::logout();
    $user->delete();
    return redirect('/');
  }
}
