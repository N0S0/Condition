@extends('layouts.app')

@include('parts.header')



@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div>
            <form action="{{route('index',['id'=>$user->id])}}" method="get" id="month-form">
              <select name="selectMonth" id="selectMonth">
                <option>選択してください</option>
                <?php
                foreach ($selectMonth as $key => $thisMonth) {
                  print('<option value="' . $thisMonth->date->format('Y-m') . '">' . $thisMonth->date->format('Y-m') . '</option>');
                }
                ?>
              </select>
            </form>
          </div>
          <h3 class="viewMonth" id="listMonth">{{$month}}の体温・体調一覧</h3>

        </div>

        <div class="card-body">
          <table>
            <thead>
              <th>日付</th>
              <th>体温</th>
              <th>症状</th>
              <th>コメント</th>
              <th>その他</th>
              <th>{{-- 下線用 --}}</th>
              <th>{{-- 下線用 --}}</th>
            </thead>
            <tbody id="condition-tbody">
              @foreach ($conditions as $condition)
              <tr>
                <td>
                  {{$condition->date->format('Y-m-d')}}
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
                  @endif
                </td>
                <td><a href="{{route('edit',['id'=>$user->id,'condition_id'=>$condition->id])}}">編集</a></td>
                <td>
                  <form action="{{route('delete',['id'=>$user->id, 'condition_id'=>$condition->id])}}" method="post"
                    class="delete-form">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="link-style-btn">削除</button>
                  </form>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div><!-- end of card-body -->
      </div><!-- end of card -->
    </div><!-- end of col-md-8 -->
  </div><!-- end of row -->
</div><!-- end of container -->

@endsection