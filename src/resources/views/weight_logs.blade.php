@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/modal.css')}}">
@endsection

@section('content')

    @if (Auth::check())
    <div>
        <div>
            <p>目標体重</p>
            <p>{{ $targetWeight }} kg</p>
        </div>
        <div>
            <p>目標まで</p>
            <p>{{ $targetWeight - $latestWeightLog->weight }} kg</p>
        </div>
        <div>
            <p>最新体重</p>
            <p>{{ $latestWeightLog->weight }} kg</p>
        </div>
    </div>

    <div>
        <div>
            <form action="/weight_logs/search" method="GET">
                <label for="start_date">開始日:</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
                
                <label for="end_date">終了日:</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
                
                <button type="submit">検索</button>

                @if (request('start_date') && request('end_date'))
                    <p>{{ request('start_date') }}〜{{ request('end_date') }}の検索結果　{{ $weightLogs->count() }}件</p>
                    <a href="{{ route('weight_logs') }}">リセット</a>
                @endif
            </form>

            <!-- モーダル表示リンク -->
            <a href="#modalWeightLog" class="open-modal">データを追加</a>

            <!-- モーダル部分 -->
            <div id="modalWeightLog" class="modal">

                <a href="#!" class="modal-overlay"></a>
                <div class="modal-content">
                    <h2>Weight Logを追加</h2>
                    <form action="{{ route('weight_logs.create') }}" method="POST">
                        @csrf
                        <label for="date">日付<span>必須</span></label>
                        <input
                            type="date"
                            id="date"
                            name="date"
                            placeholder="2024年1月1日"
                            value="{{ old('date') }}">
                        @error('date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        
                        <label for="weight">体重<span>必須</span></label>
                        <input
                        type="number"
                        id="weight"
                        name="weight"
                        step="0.1"
                        placeholder="50.0"
                        value="{{ old('weight') }}">
                        <span>kg</span>
                        @error('weight')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="calories">摂取カロリー<span>必須</span></label>
                        <input
                            type="number"
                            id="calories"
                            name="calories"
                            placeholder="1200"
                            value="{{ old('calories') }}">
                        <span>cal</span>
                        @error('calories')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="exercise_time">運動時間<span>必須</span></label>
                        <input
                            type="time"
                            id="exercise_time"
                            name="exercise_time"
                            placeholder="00:00"
                            class="default-time"
                            value="{{ old('exercise_time') }}">
                        @error('exercise_time')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="exercise_content">運動内容</label>
                        <textarea
                            id="exercise_content"
                            name="exercise_content"
                            rows="3"
                            placeholder="運動内容を追加">{{ old('exercise_content') }}
                        </textarea>
                        @error('exercise_content')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <button type="submit">登録</button>
                    </form>
                    <a href="{{ route('weight_logs') }}" class="close-modal">戻る</a>
                </div>
            </div>
            <!-- モーダル部分ここまで -->
        </div>
        @if ($weightLogs->count())
            <table>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                    <th></th>
                </tr>
                @foreach ($weightLogs as $log)
                <tr>
                    <td>{{ $log->date }}</td>
                    <td>{{ $log->weight ?? 'ーーー' }} kg</td>
                    <td>{{ $log->calories ?? 'ーーー' }} cal</td>
                    <td>{{ $log->exercise_time ?? 'ーーー' }}</td>
                    <td>
                        <a href="{{ route('weight_logs.details', ['weightLogId' => $log->id]) }}">
                            <img src="{{ asset('images/icon.pencil.png') }}" alt="詳細はこちら">
                        </a>
                    </td>
                </tr>
                @endforeach

                <!-- ページネーションリンクを表示 -->
                <tr>
                    <td colspan="5" class="text-center">
                        {{ $weightLogs->links() }}
                    </td>
                </tr>

            </table>
        @else
            <p>該当する結果はありません。</p>
        @endif
    </div>

    @endif
@endsection