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
}
