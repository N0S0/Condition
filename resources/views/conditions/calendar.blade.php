@extends('layouts.app');
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          {{$calendar->getTitle()}}
        </div>
        <div class="card-body">
          {!! $calendar->render() !!}
        </div>
      </div>
    </div>{{-- end of col-md-8 --}}
  </div>{{-- end of row --}}
</div>{{-- end of container --}}


@endsection