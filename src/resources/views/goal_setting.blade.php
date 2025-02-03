@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/modal.css')}}">
@endsection

@section('content')
    @if (Auth::check())
        <h2>目標体重設定</h2>
        
        <form action="/weight_logs/goal_setting" method="POST">
        @csrf
            <label for="target_weight">目標体重</label>
            <input type="number" id="target_weight" name="target_weight" step="0.1" value="{{ old('target_weight', $targetWeight ?? '') }}">
            <span>kg</span>

            @error('target_weight')
                <div class="error">{{ $message }}</div>
            @enderror

            <div>
                <a href="/weight_logs">戻る</a>
                <button type="submit">更新</button>
            </div>
        </form>
    @else
        <p>ログインしてください。</p>
    @endif
@endsection
