@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Today's Condition</div>

        <div class="card-body">
          <form action="{{route('todaysCondition',['id'=>$user->id])}}" method="post">
            @csrf
            <label for="date">今日の日付</label>
            <input type="date" name="date" id="date">
            <br><label for="taion">今日の体温</label>
            <input type="number" value="36.5" min="35.0" max="41.0" step="0.1" id="taion">
            {{-- <input type="text" id="taion"> --}}
            <ul class="condition-check">
              <li>症状：</li>
              <li><input type="checkbox" name="condition[]" id="taste" value="1"><label for="taste">味覚異常</label></li>
              <li><input type="checkbox" name="condition[]" id="smell" value="2"><label for="smell">嗅覚異常</label></li>
              <li><input type="checkbox" name="condition[]" id="cough" value="3"><label for="cough">咳・痰</label></li>
              <li><input type="checkbox" name="condition[]" id="malaise" value="4"><label for="malaise">倦怠感</label></li>
              <li><input type="checkbox" name="condition[]" id="physiology" value="5"><label
                  for="physiology">生理中</label></li>
            </ul>
            コメント
            <br><textarea name="comment" id="comment" cols="30" rows="10"></textarea>
            <br><input type="submit" value="記録する">
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection