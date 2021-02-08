<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Database\Seeder;



class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected function redirectTo()
  {
    return route('index', ['id' => Auth::id()]);
  }

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function username()
  {
    return 'name';
  }

  private const GUEST_USER_ID = 1;

  public function guestLogin()
  {
    if (Auth::loginUsingId(self::GUEST_USER_ID)) {
      DB::table('conditions')->select('user_id', 1)->delete();
      Artisan::call('db:seed', ['--class' => 'Database\Seeds\GuestDataSeeder']);
      return redirect()->route('index', ['id' => Auth::id()]);
    }
    return redirect()->route('index', ['id' => Auth::id()]);
  }
}
