@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Today's Condition</div>

        <div class="card-body">
          <form action="{{route('todaysCondition')}}" method="post">
            @csrf
            <label for="date">今日の日付</label>
            <input type="date" name="date" id="date">
            <br><label for="taion">体温</label>
            <input type="text" id="taion" name="taion">
            <ul class="condition-check">
              <li><input type="checkbox" name="condition" id="taste" value="1"><label for="taste">味覚異常</label></li>
              <li><input type="checkbox" name="condition" id="smell" value="1"><label for="smell">嗅覚異常</label></li>
              <li><input type="checkbox" name="condition" id="cough" value="1"><label for="cough">咳・痰</label></li>
              <li><input type="checkbox" name="condition" id="malaise" value="1"><label for="malaise">倦怠感</label></li>
              <li><input type="checkbox" name="condition" id="physiology" value="1"><label for="physiology">生理中</label></li>
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