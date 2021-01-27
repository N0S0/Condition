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
    $(function () {
  // ハンバーガーメニュー
  $(".hamburger").click(function () {
    $(this).toggleClass("active");
    if ($(this).hasClass("active")) {
      $(".nav-menu").addClass("active");
      $(".nav-menu").fadeIn(500);
    } else {
      $(".nav-menu").removeClass("active");
      $(".nav-menu").fadeOut(500);
    }
    $(".nav-menu a").click(function () {
      $(".nav-menu").removeClass("active");
      $(".nav-menu").fadeOut(1000);
      $(".hamburger").removeClass("active");
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