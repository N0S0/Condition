<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ route('welcome') }}">
      {{ config('app.name', 'Laravel') }}
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">

      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li>USER:<a href="{{route ('myPage', ['id'=>$user->id])}}">{{$user->name}}</a></li>
        <li><a href="{{route ('index', ['id'=>$user->id])}}">一覧</a></li>
        <li><a href="{{route('calendar',['id'=>$user->id])}}">カレンダー</a></li>
        <li><a href="{{route ('todaysCondition', ['id'=>$user->id])}}">記録</a></li>
        <li class="nav-item dropdown"><button><a href="{{route('logout')}}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">ログアウト</a></button>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>