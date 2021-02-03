@extends('layouts.app')

@include('parts.header')



@section('content')
<script>
  $(function() {
    $("#selectMonth").on("change", function() {
      let selectMonth = $(this).val();
      let id= {{$user->id}};

      $.ajax({
          url: `/${id}/index/${selectMonth}`,
          type: "GET",
          dataType: "json",
          data: {
            selectMonth: selectMonth,
            id: id,
          },
        })
        .done(function(data) {
          tbody(data,id,selectMonth);
        })
        .fail(function(XMLHttpRequest, textStatus, error) {
          alert("エラーが発生しました");
        });
    });

    $(document).on('click','ajax_delete',function(){
      const month = $('#selectMonth').val();
      console.log(month);
      const condition_id = $(this).data('id');
      const id = $(this).data('user_id');
      let date1 = $(this).data('date');
      date1 = date1.substr(0,7);

      $.ajax({
        url:`/${id}/index/${condition_id}/delete`,
        type:'POST',
        dataType:'json',
        data:{
          id:id,
          condition_id:condition_id,
          selectMonth:month,
        },
      }).done(function(data){
        tbody(data,id,selectMonth)
      }).fail(function(XMLHttpRequest,textStatus,error){
        alert('エラーが発生しました');
      });
    });
  });

  function tbody(data,id,selectMonth) {
    // スマホ
  if (window.matchMedia && window.matchMedia('(max-device-width: 640px)').matches) {
    $("#sp-condition-table").empty();
        const date = data[0].date.substr(0, 7);
        $("#listMonth").html(date.substr(0,4)+"年"+date.substr(5,2)+ "月<br>体温・体調一覧");
        
        for (i = 0; i < data.length; i++) {
          let th1 = $("<th>");
            th1.text("日付");
          let td1 = $("<td>");
          const date = data[i].date.replace("00:00:00", "");
          td1.text(date);

          let th2 = $("<th>");
            th2.text("体温");
          let td2 = $("<td>");

          if (data[i].taion) {
            td2.text(data[i].taion);
          }
          let th3 = $("<th>");
            th3.text("症状");
          let td3 = $("<td>");
          let text = "";
          let text2 = "";

          if (data[i].condition == null || data[i].condition == undefined) {
            text = "";
          }else{
          if (data[i].condition.indexOf("1") != -1) {
              text += "味覚異常";
          }
          if (data[i].condition.indexOf("2") != -1) {
            if(text == ""){
            text += "嗅覚異常";
            }else{
              text += "/嗅覚異常";
            }
          }
          if (data[i].condition.indexOf("3") != -1) {
            if(text == ""){
              text += '咳・痰';
            }else{
              text += "/咳・痰";
            }
          }
          if (data[i].condition.indexOf("4") != -1) {
            if(text == ""){
            text += "倦怠感";
          }else{
            text += "/倦怠感";
          }
        }
          if (data[i].condition.indexOf("5")!= -1) {
            text2 = "生理中";
          }
        }
        
          td3.text(text);

          let th4 = $("<th>");
            th4.text("コメント");
          let td4 = $("<td>");

          if (data[i].comment) {
            td4.text(data[i].comment);
          }

          let th5 = $("<th>");
            th5.text("その他");
          let td5 = $("<td>");

          td5.text(text2);

          let td6 = $("<td>");
          let a6 = $('<a>');
          a6.text('編集');
          a6.attr('href', `/${id}/index/${data[i].id}/edit`);
          td6.append(a6);

          let td7 = $("<td>");
          let a7 = $('<form />',{
            method:'post',
            action:`/${id}/index/${data[i].id}/delete`,
            class: 'delete-form',
          });
          let input_month = $('<input />',{
            type: 'hidden',
            name:'selectMonth',
            value: selectMonth,
          });
          let condition_id = $('<input />',{
            type: 'hidden',
            name:'condition_id',
            value: data[i].id,
          });
          let del = $('<input />',{
            type: 'hidden',
            name:'_method',
            value:'DELETE',
          });
          const csrf_token = $('meta[name="csrf-token"]').attr('content');
          let csrf = $('<input />',{
            type: 'hidden',
            name:'_token',
            value:csrf_token,
          });
          let btn = $('<input />',{
            type: 'submit',
            class:'link-style-btn ajax_delete',
            value:'削除',
          });
          a7.append(input_month);
          a7.append(condition_id);
          a7.append(del);
          a7.append(csrf);
          a7.append(btn);
          td7.append(a7);

          let tr1 = $('<tr>');
          let tr2 = $('<tr>');
          let tr3 = $('<tr>');
          let tr4 = $('<tr>');
          let tr5 = $('<tr>');
          let tr6 = $('<tr>');
            
          tr1.append(th1).append(td1);
          tr2.append(th2).append(td2);
          tr3.append(th3).append(td3);
          tr4.append(th4).append(td4);
          tr5.append(th5).append(td5);
          tr6.append(td6).append(td7);
          $("#sp-condition-table").append(tr1).append(tr2).append(tr3).append(tr4).append(tr5).append(tr6);
        }

  } else {//PC
    $("#condition-tbody").empty();
        const date = data[0].date.substr(0, 7);
        $("#listMonth").html(date.substr(0,4)+"年"+date.substr(5,2)+ "月<br>体温・体調一覧");
        for (i = 0; i < data.length; i++) {
          let td1 = $("<td>");
          const date = data[i].date.replace("00:00:00", "");
          td1.text(date);

          let td2 = $("<td>");

          if (data[i].taion) {
            td2.text(data[i].taion);
          }
          let td3 = $("<td>");
          let text = "";
          let text2 = "";

          if (data[i].condition == null || data[i].condition == undefined) {
            text = "";
          }else{
          if (data[i].condition.indexOf("1") != -1) {
              text += "味覚異常";
          }
          if (data[i].condition.indexOf("2") != -1) {
            if(text == ""){
            text += "嗅覚異常";
            }else{
              text += "/嗅覚異常";
            }
          }
          if (data[i].condition.indexOf("3") != -1) {
            if(text == ""){
              text += '咳・痰';
            }else{
              text += "/咳・痰";
            }
          }
          if (data[i].condition.indexOf("4") != -1) {
            if(text == ""){
            text += "倦怠感";
          }else{
            text += "/倦怠感";
          }
        }
          if (data[i].condition.indexOf("5")!= -1) {
            text2 = "生理中";
          }
        }
        
          td3.text(text);
          let td4 = $("<td>");

          if (data[i].comment) {
            td4.text(data[i].comment);
          }
          let td5 = $("<td>");


          td5.text(text2);

          let td6 = $("<td>");
          let a6 = $('<a>');
          a6.text('編集');
          a6.attr('href', `/${id}/index/${data[i].id}/edit`);
          td6.append(a6);

          let td7 = $('<td>');
          let a7 = $('<form />',{
            method:'post',
            action:`/${id}/index/${data[i].id}/delete`,
            class: 'delete-form',
          });
          let input_month = $('<input />',{
            type: 'hidden',
            name:'selectMonth',
            value: selectMonth,
          });
          let condition_id = $('<input />',{
            type: 'hidden',
            name:'condition_id',
            value: data[i].id,
          });
          let del = $('<input />',{
            type: 'hidden',
            name:'_method',
            value:'DELETE',
          });
          const csrf_token = $('meta[name="csrf-token"]').attr('content');
          let csrf = $('<input />',{
            type: 'hidden',
            name:'_token',
            value:csrf_token,
          });
          let btn = $('<input />',{
            type: 'submit',
            class:'link-style-btn ajax_delete',
            value:'削除',
          });
          a7.append(input_month);
          a7.append(condition_id);
          a7.append(del);
          a7.append(csrf);
          a7.append(btn);
          td7.append(a7);

          let tr = $("<tr>");
          tr.append(td1);
          tr.append(td2);
          tr.append(td3);
          tr.append(td4);
          tr.append(td5);
          tr.append(td6);
          tr.append(td7);
          $("#condition-tbody").append(tr);
        }
  }
}


</script>

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
                  $array =array();

                  foreach ($selectMonth as $key => $thisMonth) {
                    $array[] =$thisMonth->date->format('Y-m-01 H:i:s');
                  }

                  $uniques = array_unique($array);
                  foreach ($uniques as $unique) {
                    $date = new DateTime($unique);
                    print('<option value="' . $date->format('Y-m'). '">' .$date->format('Y年m月') .'</option>');
                  }
                ?>
              </select>
            </form>
          </div>
          <?php
          $date2 = new DateTime($month);
          ?>
          <h3 class="viewMonth" id="listMonth"><?php print($date2->format('Y年m月')); ?><br>体温・体調一覧</h3>
        </div>

        <div class="card-body">
          <?php
          $ua = $_SERVER['HTTP_USER_AGENT'];
          $browser = ((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPod') !== false) || (strpos($ua, 'Android') !== false));
          ?>
          {{-- スマホ用 --}}
          <?php if($browser == true): ?>
          <table id="sp-condition-table">
            @foreach ($conditions as $condition)
            <tr>
              <th>日付</th>
              <td>{{$condition->date->format('Y-m-d')}}</td>
            </tr>
            <tr>
              <th>体温</th>
              <td class="sp-condition-td td-taion">@if (isset($condition->taion))
                {{$condition->taion}}
                @endif</td>
            </tr>
            <tr>
              <th>症状</th>
              <td><?php $text = ''; ?>
                @if (strpos($condition->condition, '1') !== false)
                <?php 
                $text .= '味覚異常';
                ?>
                @endif
                @if (strpos($condition->condition, '2') !== false)
                <?php
                if ($text == ''){
                $text .= '嗅覚異常';
                }else{
                $text .= '/嗅覚異常';
                }
                ?>
                @endif
                @if (strpos($condition->condition, '3') !== false)
                <?php
                if ($text == ''){
                $text .= '咳・痰';
                }else{
                $text .= '/咳・痰';
                }
                ?>
                @endif
                @if (strpos($condition->condition, '4') !== false)
                <?php
                if ($text == ''){
                $text .= '倦怠感';
                }else{
                $text .= '/倦怠感';
                }
                ?>
                @endif
                {{$text}}
              </td>
            </tr>
            <tr>
              <th>コメント</th>
              <td>@if (isset($condition->comment))
                {{$condition->comment}}
                @endif</td>
            </tr>
            <tr>
              <th>その他</th>
              <td>@if (strpos($condition->condition, '5') !== false)
                <p>生理中</p>
                @endif
              </td>
            </tr>
            <tr>
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
            </thead>
            <tr>
              @endforeach

              </tbody>

          </table>


          <?php else: ?>
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
                <td><?php $text = ''; ?>
                  @if (strpos($condition->condition, '1') !== false)
                  <?php 
                $text .= '味覚異常';
                ?>
                  @endif
                  @if (strpos($condition->condition, '2') !== false)
                  <?php
                if ($text == ''){
                $text .= '嗅覚異常';
                }else{
                $text .= '/嗅覚異常';
                }
                ?>
                  @endif
                  @if (strpos($condition->condition, '3') !== false)
                  <?php
                if ($text == ''){
                $text .= '咳・痰';
                }else{
                $text .= '/咳・痰';
                }
                ?>
                  @endif
                  @if (strpos($condition->condition, '4') !== false)
                  <?php
                if ($text == ''){
                $text .= '倦怠感';
                }else{
                $text .= '/倦怠感';
                }
                ?>
                  @endif
                  {{$text}}
                </td>
                <td>@if (isset($condition->comment))
                  {{$condition->comment}}
                  @endif</td>
                <td>@if (strpos($condition->condition, '5') !== false)
                  生理中
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
          <?php endif; ?>

        </div><!-- end of card-body -->
      </div><!-- end of card -->
    </div><!-- end of col-md-8 -->
  </div><!-- end of row -->
</div><!-- end of container -->

@endsection