<?php

namespace App\Calendar;

use Carbon\Carbon;
use Faker\Provider\ar_SA\Color;
use Illuminate\Support\Facades\Auth;


class CalendarView
{
  private $carbon;

  function __construct($date)
  {
    $this->carbon = new Carbon($date);
  }

  public function getTitle()
  {
    return $this->carbon->format('Y年n月');
  }

  function render()
  {
    $html = [];
    $html[] = '<div class="calendar">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';

    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach ($weeks as $week) {
      $html[] = '<tr class="' . $week->getClassName() . '">';
      $days = $week->getDays();
      foreach ($days as $day) {
        $date = $this->carbon->format('Y-m-') . $day->render();
        $data = $this->todaysCondition($date);

        $html[] = '<td class="' . $day->getClassName() . '">';
        if (isset($data[0]->id)) {
          $html[] = '<a href="' . route('detailTodaysCondition', ['id' => Auth::id(), 'condition_id' => $data[0]->id]) . '">' . $day->render() . '</a>';
        } else {
          $html[] = $day->render();
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
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    return implode("", $html);
  }

  protected function getWeeks()
  {
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

    while ($tmpDay->lte($lastDay)) {
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }

  function todaysCondition($date)
  {
    $todaysCondition = new getCondition($date);
    return $todaysCondition->getCondition($date);
  }
}