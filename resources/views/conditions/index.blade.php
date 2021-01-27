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

  function tbody(data,id,selectMonth){
    $("#condition-tbody").empty();
        const date = data[0].date.substr(0, 7);
        $("#listMonth").html(date.substr(0,4)+"年"+date.substr(5,2)+ "月：体温・体調一覧");
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
            text = '';
          }else{
          if (data[i].condition.indexOf("1") != -1) {
              text += "味覚異常";
          }
          if (data[i].condition.indexOf("2") != -1) {
            text += "/嗅覚異常";
          }
          if (data[i].condition.indexOf("3") != -1) {
            text += "/咳";
          }
          if (data[i].condition.indexOf("4") != -1) {
            text += "/倦怠感";
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
          <h3 class="viewMonth" id="listMonth"><?php print($date2->format('Y年m月')); ?>：体温・体調一覧</h3>

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