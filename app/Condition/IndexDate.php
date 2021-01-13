<?php

namespace App\Condition;

use Carbon\Carbon;
use App\Http\Controllers\ConditionController;
use Symfony\Component\VarDumper\VarDumper;

class IndexDate
{
  private $carbon;

  function __construct()
  {
    $this->carbon = new Carbon();
  }

  public function getMonth()
  {
    $month = $this->carbon->format('Y-m');
    return $month;
  }

  public function prevMonth()
  {
    $year = $this->carbon->format('Y');
    $month = $this->carbon->format('n');
    if (1 < $month) {
      $month--;
    } else {
      $year--;
      $month = 12;
    }
    $prevMonth = $year . '-' . $month;
    return $prevMonth;
  }

  public function nextMonth()
  {
    $year = $this->carbon->format('Y');
    $month = $this->carbon->format('n');

    if ($month < 12) {
      $month  += 1;
    } else {
      $year += 1;
      $month = 1;
    }
    $nextMonth = $year . '-' . $month;
    return $nextMonth;
  }
}