@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Today's Condition</div>
        <div class="card-body">
          <span for="date">日付：</span>{{$condition[0]->date->format('Y-m-d')}}
          <br><span for="taion">体温：</span>@if(isset($condition[0]->taion)){{$condition[0]->taion}}@endif
          <ul class="condition-check">
            <li>症状：</li>
            <li>@if (strpos($condition[0]->condition, '1') !== false)
              味覚異常
              @endif
              @if (strpos($condition[0]->condition, '2') !== false)
              /嗅覚異常
              @endif
              @if (strpos($condition[0]->condition, '3') !== false)
              /咳
              @endif
              @if (strpos($condition[0]->condition, '4') !== false)
              /倦怠感
              @endif
            </li>
          </ul>
          コメント:@if(isset($condition[0]->comment))
          {{$condition[0]->comment}}
          @endif
        </div><!-- end of card-body -->
      </div><!-- end of card -->
    </div><!-- end of col-md-8 -->
  </div><!-- end of row -->
</div><!-- end of container -->
@endsection