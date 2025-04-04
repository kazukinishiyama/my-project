<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '家計簿') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- BootstrapのCSSを読み込む -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="my-navbar-control">
        @if(Auth::check())
            <span class="my-navbar-item">{{ Auth::user()->name}}</span>
            /
            <!-- <a href="#" id="lougout" class="my-navbar-item">ログアウト</a> -->
            <form href="#" id="logout-from" action="{{ route('logout')}}" method="POST" style="display: nome;">
                @csrf
                <input type="submit" value="ログアウト"></input>
            </form>

        @else
            <a class="my-navbar-item" href="{{ route('login')}}">ログイン</a>
            /
            <a class="my-navbar-item" href="{{ route('register')}}">会員登録</a>
        @endif
    </div>
    <!-- <script>
        document.getElementById('logout').addEventListener('click,'function (event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });
    </script> -->
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    家計簿
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- BootstrapのJSを読み込む -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>