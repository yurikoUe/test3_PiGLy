<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/register_steps.css')}}">
</head>
<body class="body">
    <div class="register-form">
        <img src="{{ asset('images/PiGLy.png') }}" alt="Logo">
        <h1 class="register-form__title">新規会員登録</h1>
        <p class="register-form__step">STEP1 アカウント情報の登録</p>
        <div class="register-form__container">
            <form action="/register/step1" method="POST">
                @csrf
                <label class="register-form__label" for="name">お名前</label>
                <input
                    id="name"
                    class="register-form__input"
                    placeholder="名前を入力"
                    type="text"
                    name="name"
                    value="{{ old('name') }}" />
                @error('name')
                    <div class="register-form__error">{{ $message }}</div>
                @enderror

                <label class="register-form__label" for="email">メールアドレス</label>
                <input
                    id="email"
                    class="register-form__input"
                    placeholder="メールアドレスを入力"
                    type="email"
                    name="email"
                    value="{{ old('email') }}" />
                @error('email')
                    <div class="register-form__error">{{ $message }}</div>
                @enderror

                <label class="register-form__label" for="password">パスワード</label>
                <input
                    id="password"
                    class="register-form__input"
                    placeholder="パスワードを入力"
                    type="password"
                    name="password" />
                @error('password')
                    <div class="register-form__error">{{ $message }}</div>
                @enderror

                <button class="register-form__button" type="submit">次に進む</button>
            </form>
            <a class="register-form__link" href="/login">ログインはこちら</a>
        </div>
    </div>
    
</body>
</html>