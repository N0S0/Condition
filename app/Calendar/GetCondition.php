<?php

namespace App\Calendar;

use App\Models\Condition;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class GetCondition
{

  function getCondition($date)
  {
    $id = Auth::id();
    $getCondition = DB::table('conditions')->where('user_id', $id)->whereDate('date', $date)->get();
    return $getCondition;
  }
}
