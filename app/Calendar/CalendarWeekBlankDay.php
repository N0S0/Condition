<?php

namespace App\Calendar;

class CalendarWeekBlankDay extends CalendarWeekDay{
  function getClassName()
  {
    return "day-blank";
  }

  function render(){
    return '';
  }
}