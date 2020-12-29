@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Conditions</div>

        <div class="card-body">
          <table>
            <thead>
              <th>日付</th>
              <th>体温</th>
              <th>症状</th>
              <th>コメント</th>
              <th>その他</th>
            </thead>
            <tbody>
              @foreach ($conditions as $condition)
              <tr>
                <td>
                  {{$condition->date}}
                </td>
                <td>@if (isset($condition->taion))
                  {{$condition->taion}}
                  @endif</td>
                <td>@if (strpos($condition->condition, '1') !== false)
                  味覚異常
                  @endif
                  @if (strpos($condition->condition, '2') !== false)
                  /嗅覚異常
                  @endif
                  @if (strpos($condition->condition, '3') !== false)
                  /咳
                  @endif
                  @if (strpos($condition->condition, '4') !== false)
                  /倦怠感
                  @endif</td>
                <td>@if (isset($condition->comment))
                  {{$condition->comment}}
                  @endif</td>
                <td>@if (strpos($condition->condition, '5') !== false)
                  <p>生理中</p>
                  @endif</td>
                <td><a href="{{route('edit',['id'=>$user->id,'condition_id'=>$condition->id])}}">編集</a></td>
                <td><a href="#">削除</a></td>
              </tr>
              @endforeach

            </tbody>
          </table>








        </div>
      </div>
    </div>
  </div>
</div>
@endsection