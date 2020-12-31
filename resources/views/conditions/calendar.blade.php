@extends('layouts.app');
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header calendar-header">
          <div>{{$calendar->getTitle()}}</div>
          <div><ul class="annotation">
            <li class="taion-green">●37.5℃未満</li>
            <li class="taion-red">●37.5℃以上</li>
            <li class="calendar-condition">▲症状あり</li>
            <li class="calendar-physiology">■生理中</li>
            <li>◆コメントあり</li>
          </ul></div>
        </div>
        <div class="card-body">
          {!! $calendar->render() !!}
        </div>
      </div>
    </div>{{-- end of col-md-8 --}}
  </div>{{-- end of row --}}
</div>{{-- end of container --}}


@endsection