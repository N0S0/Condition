@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Conditions</div>

        <div class="card-body">
          @foreach ($conditions as $condition)
          <table>
            <thead>
              <th>日付</th>
              <th>体温</th>
              <th>体調</th>
              <th>コメント</th>
              <th>その他</th>
            </thead>
            <tbody>
              <td>
                {{$condition->created_at}}
              </td>
              <td>@if (isset($condition->taion))
                {{$condition->taion}}
                @endif</td>
              <td>@if ($condition->taste == 1)
                味覚異常
                @endif
                @if ($condition->smell == 1)
                /嗅覚異常
                @endif
                @if ($condition->cough == 1)
                /咳
                @endif
                @if ($condition->malaise == 1)
                /倦怠感
                @endif</td>
              <td>@if (isset($condition->comment))
                {{$condition->comment}}
                @endif</td>
              <td>@if ($condition->physiology == 1)
                <p>生理中</p>
                @endif</td>
                <td>編集</td>
                <td>削除</td>

            </tbody>
          </table>




          



          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection