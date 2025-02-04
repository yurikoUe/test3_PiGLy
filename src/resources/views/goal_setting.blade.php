@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/goal_setting.css')}}">
@endsection

@section('content')
    @if (Auth::check())
    <div class="goal-setting">
        <h2 class="goal-setting__title">目標体重設定</h2>
        <form class="goal-setting__form" action="/weight_logs/goal_setting" method="POST">
        @csrf
            <div class="goal-setting__input-wrapper">
                <input class="goal-setting__input" type="number" id="target_weight" name="target_weight" step="0.1" value="{{ old('target_weight', $targetWeight ?? '') }}">
                <span class="goal-setting__unit">kg</span>
            </div>
            @error('target_weight')
                <div class="goal-setting__error">{{ $message }}</div>
            @enderror
            <div class="goal-setting__actions">
                <a class="goal-setting__back-link" href="/weight_logs">戻る</a>
                <button class="goal-setting__submit-button" type="submit">更新</button>
            </div>
        </form>
    @else
        <p class="goal-setting__message">ログインしてください。</p>
    @endif
    </div>
@endsection
