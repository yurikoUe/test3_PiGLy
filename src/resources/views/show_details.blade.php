@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/details.css')}}">
@endsection

@section('content')
    @if (Auth::check())
    <div class="weight-logs">
        <h2 class="weight-log__title">Weight Log</h2>
        <form action="{{ route('weight_logs.update', ['weightLogId' => $log->id]) }}" method="POST" class="weight-log__form">
            @csrf

            <label for="date" class="weight-log__label">日付</label>
            <input type="date" id="date" name="date" value="{{ $log->date }}" class="weight-log__input">
            @error('date')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="weight" class="weight-log__label">体重</label>
            <div class="weight-log__input-group">
                <input type="number" id="weight" name="weight" step="0.1" value="{{ $log->weight }}" class="weight-log__input">
                <span class="weight-log__unit">kg</span>
            </div>
            @error('weight')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="calories" class="weight-log__label">摂取カロリー</label>
            <div class="weight-log__input-group">
                <input type="number" id="calories" name="calories" value="{{ $log->calories }}" class="weight-log__input">
                <span class="weight-log__unit">cal</span>
            </div>
            @error('calories')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="exercise_time" class="weight-log__label">運動時間</label>
            <input type="time" id="exercise_time" name="exercise_time" value="{{ $log->exercise_time }}" class="weight-log__input">
            @error('exercise_time')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="exercise_content" class="weight-log__label">運動内容</label>
            <textarea id="exercise_content" name="exercise_content" class="weight-log__input">{{ $log->exercise_content }}</textarea>
            @error('exercise_content')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="weight-log__actions">
                <a href="/weight_logs" class="weight-log__back-link">戻る</a>
                <button type="submit" class="weight-log__submit-button">更新</button>
            </div>
        </form>

        <!-- 体重削除フォーム -->
        <form action="{{ route('weight_logs.delete', ['weightLogId' => $log->id]) }}" method="POST" class="weight-log__delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="weight-log__delete-button">
                <img src="{{ asset('images/icon.trash.png') }}" alt="削除" class="weight-log__delete-icon" >
            </button>
        </form>
    </div>
    @endif
@endsection