<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <img src="{{ asset('images/PiGLy.png') }}" alt="Logo">
        <h1>新規会員登録</h1>
        <p>STEP1 アカウント情報の登録</p>
        <div>
            <form action="/register/step1" method="POST">
                @csrf
                <label for="">お名前</label>
                <input type="text" name="name" value="{{ old('name') }}" />
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" />
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="">パスワード</label>
                <input type="password" name="password" />
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button type="submit">次に進む</button>
            </form>
            <a href="/login">ログインはこちら</a>
        </div>
    </div>
    
</body>
</html>