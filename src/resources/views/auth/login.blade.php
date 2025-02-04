<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
</head>
<body class="body">
    <div class="login-form">
        <img src="{{ asset('images/PiGLy.png') }}" alt="Logo">
        <h1 class="login-form__title">ログイン</h1>
        <div class="login-form__container">
            <form action="/login" method="post">
                @csrf
                <label class="login-form__label" for="email">メールアドレス</label>
                <input
                    class="login-form__input"
                    type="email" name="email"
                    id="email"
                    placeholder="メールアドレスを入力"
                    value="{{ old('email') }}" />
                @error('email')
                    <div class="login-form__error">{{ $message }}</div>
                @enderror

                <label class="login-form__label" for="password">パスワード</label>
                <input
                    class="login-form__input"
                    type="password"
                    name="password"
                    placeholder="パスワードを入力"
                    id="password" />
                @error('password')
                    <div class="login-form__error">{{ $message }}</div>
                @enderror
                @if ($errors->has('login'))
                    <div class="login-form__error">{{ $errors->first('login') }}</div>
                @endif

                <button class="login-form__button" type="submit">次に進む</button>
            </form>
            <a class="register-form__link" href="/register/step1">アカウント作成はこちら</a>
        </div>
    </div>
</body>
</html>