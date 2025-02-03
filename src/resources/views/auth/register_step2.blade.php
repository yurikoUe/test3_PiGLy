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
        <h1>新規会員登録</h1>
        <p>STEP2 体重データの入力</p>
        <div>
            <form action="{{ route('register.step2') }}" method="POST">
                @csrf
                <label for="weight">現在の体重</label>
                <input
                type="number"
                step="0.1"
                id="weight"
                name="weight"
                value="{{ old('weight') }}" />
                @error('weight')
                    <span class="error">{{ $message }}</span>
                @enderror
                <label for="target_weight">目標体重</label>
                <input
                type="number"
                step="0.1"
                id="target_weight"
                name="target_weight"
                value="{{ old('target_weight') }}" />
                @error('target_weight')
                    <span class="error">{{ $message }}</span>
                @enderror
                <button type="submit">アカウント作成</button>
            </form>
        </div>
    </div>
    
</body>
</html>