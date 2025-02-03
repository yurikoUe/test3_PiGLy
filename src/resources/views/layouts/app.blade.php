<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <div class="app">
        <header>
            <div>
                <img src="{{ asset('images/PiGLy.png') }}" alt="logo">
                <div>
                    <a href="{{ route('goal_setting_form') }}">目標体重設定</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="header-nav__button">ログアウト</button>
                    </form>
                </div>
            </div>
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>