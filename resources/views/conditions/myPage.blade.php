@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">MyPage</div>

        <div class="card-body">
          <ul>
            <li>ユーザー名：{{$user->name}}</li>
            <li>email：@if(isset($user->email))
              {{$user->email}}
              @else
              未登録
              @endif</li>
            <li>利用開始日：{{$date}}</li>
          </ul>
          @if (Auth::id() != 1)
          <a href="{{route('closeAccount', ['id'=>$user->id])}}">アカウントを削除する</a>
          @elseif(Auth::id() ==1)
          ※ゲストアカウントは削除できません
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection