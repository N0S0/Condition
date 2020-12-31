<?php

namespace App\Calendar;

use App\Models\Condition;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class getCondition{

  function getCondition($date){
    // 日付を取得するには？？？？
    // $getCondition = Condition::find($date);
    $getCondition = DB::table('conditions')->whereDate('date',$date)->get();
    // $taion = $getCondition->taion;
    // $condition = $getCondition->condition;
    // return [$taion,$condition];
    return $getCondition;
  }
}