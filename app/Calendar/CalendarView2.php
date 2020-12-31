<?php

  namespace App\Calendar;
  use Carbon\Carbon;

  class CalendarView{
    private $carbon;

    function __construct($date){
      $this->carbon = new Carbon($date);
    }

    public function getTitle(){
      return $this->carbon->format('Y年n月');
    }

    public function today(){
      return $this->carbon;
    }

    function render(){
      $html =[];
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
      $weeks = $this->getWeeks();
      foreach($weeks as $week){
        $html[] = '<tr class="'.$week->getClassName().'">';
        $days = $week->getDays();
        foreach($days as $day){
          $html[] = '<td class="'.$day->getClassName().'">';
          $html[] = $day->render();
          $html[] = '</td>';
        }
        $html[] = '</tr>';
      }
      $html[] = '</tbody>';
      $html[] = '</table>';
      $html[] = '</div>';
      return implode("", $html);
    }

    protected function getWeeks(){
      $weeks = [];
      $firstDay = $this->carbon->copy()->firstOfMonth();
      $lastDay = $this->carbon->copy()->lastOfMonth();
      $week = new CalendarWeek($firstDay->copy());
      $weeks[] = $week;
      $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

      while($tmpDay->lte($lastDay)){
        $week = new CalendarWeek($tmpDay, count($weeks));
        $weeks[] = $week;
        $tmpDay->addDay(7);
      }
      return $weeks;
    }
  }