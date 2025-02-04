<!DOCTYPE html>
<html lang="ja">
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
        <p class="register-form__step">STEP2 体重データの入力</p>
        <div class="register-form__container">
            <form action="{{ route('register.step2') }}" method="POST">
                @csrf
                <label class="register-form__label" for="weight">現在の体重</label>
                <div class="register-form__input-wrapper">
                    <input
                        class="register-form__input"
                        type="number"
                        step="0.1"
                        id="weight"
                        name="weight"
                        placeholder="現在の体重を入力"
                        value="{{ old('weight') }}" />
                    <p class="register-form__unit">kg</p>
                </div>
                    @error('weight')
                    <div class="register-form__error">{{ $message }}</div>
                @enderror

                <label  class="register-form__label" for="target_weight">目標体重</label>
                <div class="register-form__input-wrapper">
                    <input
                        class="register-form__input"
                        type="number"
                        step="0.1"
                        id="target_weight"
                        name="target_weight"
                        placeholder="目標の体重を入力"
                        value="{{ old('target_weight') }}" />
                    <p class="register-form__unit">kg</p>
                </div>
                @error('target_weight')
                    <div class="register-form__error">{{ $message }}</div>
                @enderror
                <button class="register-form__button" type="submit">アカウント作成</button>
            </form>
        </div>
    </div>
    
</body>
</html>