<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__logo-container">
            <a href="{{ route('weight_logs') }}">
                <img src="{{ asset('images/PiGLy.png') }}" alt="logo" class="header__logo">
            </a>
            <div  class="header__nav">
                <a href="{{ route('goal_setting_form') }}" class="header__nav-link">目標体重設定</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="header__nav-button">ログアウト</button>
                </form>
            </div>
        </div>
    </header>
    <div class="header__line"></div>
    <div class="content">
        @yield('content')
    </div>
</body>

</html>