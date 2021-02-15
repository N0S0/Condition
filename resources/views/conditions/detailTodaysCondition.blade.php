@extends('layouts.app')
@include('parts.header')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Today's Condition</div>
        <div class="card-body">
          <span for="date">日付：</span>{{$condition[0]->date->format('Y-m-d(D)')}}
          <br><span for="taion">体温：</span>@if(isset($condition[0]->taion)){{$condition[0]->taion}}@endif℃
          {{-- <ul class="condition-check"> --}}
          <br>症状：<?php $text = ''; ?>
          @if (strpos($condition[0]->condition, '1') !== false)
          <?php 
                $text .= '味覚異常';
                ?>
          @endif
          @if (strpos($condition[0]->condition, '2') !== false)
          <?php
                if ($text == ''){
                $text .= '嗅覚異常';
                }else{
                $text .= '/嗅覚異常';
                }
                ?>
          @endif
          @if (strpos($condition[0]->condition, '3') !== false)
          <?php
                if ($text == ''){
                $text .= '咳・痰';
                }else{
                $text .= '/咳・痰';
                }
                ?>
          @endif
          @if (strpos($condition[0]->condition, '4') !== false)
          <?php
                if ($text == ''){
                $text .= '倦怠感';
                }else{
                $text .= '/倦怠感';
                }
                ?>
          @endif
          {{$text}}

          <br>コメント:@if(isset($condition[0]->comment))
          {{$condition[0]->comment}}
          @endif
        </div><!-- end of card-body -->
      </div><!-- end of card -->
    </div><!-- end of col-md-8 -->
  </div><!-- end of row -->
</div><!-- end of container -->
@endsection