@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">編集する</div>
        <div class="card-body">
          <form action="{{route('edit',['id'=>$user->id,'condition_id'=>$condition->id])}}" method="post">
            @csrf
            <label for="date">今日の日付</label>
            <input type="date" name="text" id="date" value="{{old('date', $condition['date'])->format('Y-m-d')}}">
            <br><label for="taion">今日の体温</label>
            <input type="number" id="taion" step="0.1" value="{{old('taion', $condition['taion'])}}" name="taion">℃
            <ul class="condition-check">
              <li>症状：</li>
              @if (strpos($condition['condition'],'1') !== false)
              <li><input type="checkbox" name="condition[]" id="taste" value="1" checked><label for="taste">味覚異常</label>
              </li>
              @else
              <li><input type="checkbox" name="condition[]" id="taste" value="1"><label for="taste">味覚異常</label></li>
              @endif
              @if (strpos($condition['condition'],'2') !== false)
              <li><input type="checkbox" name="condition[]" id="smell" value="2" checked><label for="smell">嗅覚異常</label>
              </li>
              @else
              <li><input type="checkbox" name="condition[]" id="smell" value="2"><label for="smell">嗅覚異常</label></li>
              @endif
              @if (strpos($condition['condition'],'3') !== false)
              <li><input type="checkbox" name="condition[]" id="cough" value="3" checked><label for="cough">咳・痰</label>
              </li>
              @else
              <li><input type="checkbox" name="condition[]" id="cough" value="3"><label for="cough">咳・痰</label></li>
              @endif
              @if (strpos($condition['condition'],'4') !== false)
              <li><input type="checkbox" name="condition[]" id="malaise" value="4" checked><label
                  for="cough">倦怠感</label></li>
              @else
              <li><input type="checkbox" name="condition[]" id="malaise" value="4"><label for="cough">倦怠感</label></li>
              @endif
              @if (strpos($condition['condition'],'5') !== false)
              <li><input type="checkbox" name="condition[]" id="physiology" value="5" checked><label
                  for="cough">生理中</label></li>
              @else
              <li><input type="checkbox" name="condition[]" id="physiology" value="5"><label for="cough">生理中</label>
              </li>
              @endif
            </ul>
            コメント
            <br><textarea name="comment" id="comment" cols="30"
              rows="10">{{old('date', $condition['comment'])}}</textarea>
            <br><input type="submit" value="記録する">
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection