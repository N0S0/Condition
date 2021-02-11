<?php

namespace App\Calendar;

use Carbon\Carbon;
use Faker\Provider\ar_SA\Color;
use Illuminate\Support\Facades\Auth;


class CalendarView
{
  private $carbon;

  function __construct()
  {
    $this->carbon = new Carbon();
  }

  public function getTitle()
  {
    return $this->carbon->format('Y年n月');
  }

  public function calendarDate()
  {
    $getDates = [];
    $startDate = $this->carbon->copy()->firstOfMonth();
    $lastDate = $this->carbon->copy()->lastOfMonth();
    $getDate = $startDate->copy();
    $startDay = $startDate->dayOfWeek;
    $lastDay = $lastDate->dayOfWeek;

    // 前月
    for($i = $startDay; $i >= 1; $i--){
      $getDates[] = $startDate->copy()->subDay($i);
    }
    // 今月
    while ($getDate->lte($lastDate)) {
      $getDates[] = $getDate->copy();
      $getDate->addDay(1);
    }
    // 来月
    for($i = 1; $i < (7 - $lastDay); $i++){
      $getDates[] = $lastDate->copy()->addDay($i);
    }
    return $getDates;
  }


  function view()
  {
    $html = [];
    $html[] = '<div class="calendar">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>日</th>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';

    $html[] = '<tbody>';


    $viewDates = $this->calendarDate();
    $html[] = '<tr>';
    $i = 0;

    foreach ($viewDates as $viewDate) {
      $date = $viewDate;
      //その日の体調
      $data = $this->todaysCondition($date);

      if($viewDate->format('m') == $this->carbon->format('m')){
        $html[] = '<td class="' . $viewDate->format('D') . '">';
      }else{
        $html[] = '<td class="not-thisMonth">';
      }

      if (isset($data[0]->id)) {
        $html[] = '<a href="' . route('detailTodaysCondition', ['id' => Auth::id(), 'condition_id' => $data[0]->id]) . '">' . $viewDate->format('j') . '</a>';
      } else {
        $html[] = $viewDate->format('j');
      }
      $html[] = '<br>';

      if (isset($data[0]->taion)) {
        // var_dump($data[0]->taion);
        if ($data[0]->taion < 37.5) {
          $html[] = '<p class="taion-green">●</p>';
        } else {
          $html[] = '<p class="taion-red">●</p>';
        }
      }
      if (isset($data[0]->condition)) {
        $val1 = '/1|2|3|4/';
        if (preg_match($val1, $data[0]->condition) == 1) {
          $html[] = '<p class="calendar-condition">▲</p>';
        }
        $val2 = '/5/';
        if (preg_match($val2, $data[0]->condition) == 1) {
          $html[] = '<p class="calendar-physiology">■</p>';
        }
      }
      if (isset($data[0]->comment)) {
        $html[] = '<p class="calendar-comment">◆</p>';
      }

      $html[] = '</td>';
      $i++;
      if ($i % 7 == 0) {
        $html[] = '</tr>';
      }
    }

    $html[] = '</tr>';

    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    return implode("", $html);
  }

  function todaysCondition($date)
  {
    $todaysCondition = new GetCondition($date);
    return $todaysCondition->getCondition($date);
  }
}
