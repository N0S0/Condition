<?php

namespace App\Calendar;

use App\Models\Condition;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class getCondition{

  function getCondition($date){
    $getCondition = DB::table('conditions')->whereDate('date',$date)->get();
    return $getCondition;
  }
}