<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <img src="{{ asset('images/PiGLy.png') }}" alt="Logo">
        <h1>ログイン</h1>
        <form action="/login"  method="post">
            @csrf
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" />
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror

            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" />
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
            @if ($errors->has('login'))
                <span class="error">{{ $errors->first('login') }}</span>
            @endif

            <button type="submit">次に進む</button>
        </form>
        <a href="/register/step1">アカウント作成はこちら</a>
    </div>
</body>
</html>