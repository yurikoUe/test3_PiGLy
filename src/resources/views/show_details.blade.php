@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/modal.css')}}">
@endsection

@section('content')
    @if (Auth::check())
    
    <h2>Weight Log</h2>
    <form action="{{ route('weight_logs.update', ['weightLogId' => $log->id]) }}" method="POST">
        @csrf

        <label for="date">日付</label>
        <input type="date" id="date" name="date" value="{{ $log->date }}">
        <span>kg</span>
        @error('date')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="weight">体重</label>
        <input type="number" id="weight" name="weight" step="0.1" value="{{ $log->weight }}">
        <span>kg</span>
        @error('weight')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="calories">摂取カロリー</label>
        <input type="number" id="calories" name="calories" value="{{ $log->calories }}">
        <span>cal</span>
        @error('calories')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="exercise_time">運動時間</label>
        <input type="time" id="exercise_time" name="exercise_time" value="{{ $log->exercise_time }}">
        @error('exercise_time')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="exercise_content">運動内容</label>
        <textarea id="exercise_content" name="exercise_content">{{ $log->exercise_content }}</textarea>
        @error('exercise_content')
            <div class="error">{{ $message }}</div>
        @enderror

        <div>
            <a href="/weight_logs">戻る</a>
            <button type="submit">更新</button>
        </div>
        </form>

        <!-- 体重削除フォーム -->
        <form action="{{ route('weight_logs.delete', ['weightLogId' => $log->id]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                <img src="{{ asset('images/icon.trash.png') }}" alt="削除" style="width: 20px; height: 20px;">
            </button>
        </form>

    @endif
@endsection