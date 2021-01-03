@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">アカウント削除</div>

        <div class="card-body">
          <ul>
            <li>ユーザー名：{{$user->name}}</li>
            <li>email：@if(isset($user->email))
              {{$user->email}}@endif</li>
            <li>利用開始日：{{$date}}</li>
          </ul>
          <p class="delete-message">アカウントを削除しますか？</p>
          <ul class="closeAccount">
            <li><a href="{{route ('closeAccount', ['id'=>$user->id])}}">マイページに戻る</a></li>
            <li><form action="{{route('closeAccount',['id'=>$user->id])}}" method="post"
              class="closeAccount-form">
              @method('DELETE')
              @csrf
              <button type="submit" class="link-style-btn">削除する</button>
            </form></li>
          </ul>


        </div>
      </div>
    </div>
  </div>
</div>
@endsection