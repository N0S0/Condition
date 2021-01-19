<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script>
    $(function() {
      $("#selectMonth").on("change", function() {
        let selectMonth = $(this).val();
        let id= {{$user->id}};
  
        $.ajax({
            url: "/{id}/index/{selectMonth}",
            type: "GET",
            dataType: "json",
            data: {
              selectMonth: selectMonth,
              id: id,
            },
          })
          .done(function(data) {
            $("#condition-tbody").empty();
            const date = data[0].date.substr(0, 7);
            $("#listMonth").text(date + "の体温・体調一覧");
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
              if (data[i].condition.indexOf("1") != -1) {
                text += "味覚異常";
              }
              if (data[i].condition.indexOf("2")!= -1) {
                text += "/嗅覚異常";
              }
              if (data[i].condition.indexOf("3")!= -1) {
                text += "/咳";
              }
              if (data[i].condition.indexOf("4")!= -1) {
                text += "/倦怠感";
              }
              td3.text(text);
              let td4 = $("<td>");
  
              if (data[i].comment) {
                td4.text(data[i].comment);
              }
              let text2 = "";
              let td5 = $("<td>");
  
              if (data[i].condition.indexOf("5")!= -1) {
                text2 = "生理中";
              }
              td5.text(text2);
  
              let td6 = $("<td>");
              let a6 = $('<a>');
              a6.text('編集');
              a6.attr('href', `/${id}/index/${data[i].id}/edit`);
              td6.append(a6);
  
              let td7 = $('<td>');
  
  
  
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
          })
          .fail(function(XMLHttpRequest, textStatus, error) {
            alert("エラーが発生しました");
          });
      });
    });
    </script>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>
  @yield('header')
  <main class="py-4">
    @yield('content')
  </main>
  </div>
</body>

</html>