<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>PhotoShare</title>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" defer></script>
  <script src="{{ asset('js/main.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />

  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          PhotoShare
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto"></ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __("Login") }}</a>
            </li>
            @endif @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __("Register") }}</a>
            </li>
            @endif @else @if (Auth::user()->image)

            <li class="nav-item">
              <img src="{{ url('/user/avatar/' . Auth::user()->image) }}" alt="avatar" class="avatar" />
            </li>

            @endif
            <li class="nav-item">
              <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" v-pre style="color: black">
                Hello,{{ Auth::user()->name }}
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('image.create') }}">Upload images</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('viewLikes') }}">Favorites</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('settings') }}">Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('profile', ['id' => Auth::user()->id]) }}">Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.getUsers') }}">Users</a>
            </li>

            <li class="nav-item">
              <a id="navbarDropdown" class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                                                                                                                 document.getElementById('logout-form').submit();">
                {{ __("Logout") }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">@yield('content')</main>
  </div>
</body>

</html>