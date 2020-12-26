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
              <li><label for="taste">味覚異常</label><input type="checkbox" name="taste" id="taste"></li>
              <li><label for="smell">嗅覚異常</label><input type="checkbox" name="smell" id="smell"></li>
              <li><label for="cough">咳・痰</label><input type="checkbox" name="cough" id="cough"></li>
              <li><label for="malaise">倦怠感</label><input type="checkbox" name="malaise" id="malaise"></li>
              <li><label for="physiology">生理中</label><input type="checkbox" name="physiology" id="physiology"></li>
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