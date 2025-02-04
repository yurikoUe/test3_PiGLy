@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/modal.css')}}">
<link rel="stylesheet" href="{{ asset('css/weight_logs.css')}}">
@endsection

@section('content')

    @if (Auth::check())
        <div class="weight-log__summary">
            <div class="weight-log__summary-item">
                <p class="weight-log__label">目標体重</p>
                <div class="weight-log__value">
                    <p class="weight-log__value-data">{{ $targetWeight }}</p>
                    <p  class="weight-log__kg">kg</p>
                </div>
                
            </div>
            <div class="weight-log__summary-item">
                <p class="weight-log__label">目標まで</p>
                <div class="weight-log__value">
                    <p class="weight-log__value-data">{{ $targetWeight - $latestWeightLog->weight }}</p>
                    <p  class="weight-log__kg">kg</p>
                </div>
            </div>
            <div class="weight-log__summary-item">
                <p class="weight-log__label">最新体重</p>
                <div class="weight-log__value">
                    <p class="weight-log__value-data">{{ $latestWeightLog->weight }}</p>
                    <p  class="weight-log__kg">kg</p>
                </div>
            </div>
        </div>

    
        <div class="weight-log__search">
            <form action="/weight_logs/search" method="GET" class="weight-log__search-form">
                <div class="weight-log__search-form--left">
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="weight-log__search-input">
                    <p>〜</p>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="weight-log__search-input">
                    <button type="submit" class="weight-log__search-button">検索</button>
                </div>
                <div class="weight-log__search-form--right">
                    <!-- モーダル表示リンク -->
                    <a href="#modalWeightLog" class="weight-log__open-modal">データを追加</a>
                </div>
        </div>
        <div class="weight-log__search-results">
                @if (request('start_date') && request('end_date'))
                    <p class="weight-log__search-period">
                        {{ request('start_date') }}〜{{ request('end_date') }}の検索結果　{{ $weightLogs->count() }}件
                    </p>
                    <a href="{{ route('weight_logs') }}" class="weight-log__search-reset">リセット</a>
                @endif
            </form>
        </div>

        

        <!-- モーダル部分 -->
        <div id="modalWeightLog" class="modal">

            <a href="#!" class="modal-overlay"></a>
            <div class="modal-content">
                <h2 class="modal__title">Weight Logを追加</h2>
                <form action="{{ route('weight_logs.create') }}" method="POST" class="modal__form">
                    @csrf
                    <label for="date" class="modal__label">日付<span class="modal__required">必須</span></label>
                    <input
                        type="date"
                        id="date"
                        name="date"
                        placeholder="2024年1月1日"
                        value="{{ old('date') }}"
                        class="modal__input">
                    @error('date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    
                    <label for="weight" class="modal__label">体重<span class="modal__required">必須</span></label>
                    <div class="modal__input--with-unit">
                        <input
                            type="number"
                            id="weight"
                            name="weight"
                            step="0.1"
                            placeholder="50.0"
                            value="{{ old('weight') }}"
                            class="modal__input">
                        <span class="modal__input--unit">kg</span>
                    </div>
                    @error('weight')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <label for="calories" class="modal__label">摂取カロリー<span class="modal__required">必須</span></label>
                    <div class="modal__input--with-unit">
                        <input
                            type="number"
                            id="calories"
                            name="calories"
                            placeholder="1200"
                            value="{{ old('calories') }}"
                            class="modal__input">
                        <span class="modal__input--unit">cal</span>
                    </div>
                    @error('calories')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <label for="exercise_time" class="modal__label">運動時間<span class="modal__required">必須</span></label>
                    <input
                        type="time"
                        id="exercise_time"
                        name="exercise_time"
                        placeholder="00:00"
                        class="default-time"
                        value="{{ old('exercise_time') }}"
                        class="modal__input">
                    @error('exercise_time')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <label for="exercise_content" class="modal__label">運動内容</label>
                    <textarea
                        id="exercise_content"
                        name="exercise_content"
                        rows="3"
                        placeholder="運動内容を追加"
                        class="modal__input">{{ old('exercise_content') }}
                    </textarea>
                    @error('exercise_content')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="modal__submit-button">登録</button>
                </form>
                <a href="{{ route('weight_logs') }}" class="close-modal">戻る</a>
            </div>
        </div>
        <!-- モーダル部分ここまで -->
        
        @if ($weightLogs->count())
            <table class="weight-log__table">
                <tr class="weight-log__table-header">
                    <th class="weight-log__table-header-item">日付</th>
                    <th class="weight-log__table-header-item">体重</th>
                    <th class="weight-log__table-header-item">食事摂取カロリー</th>
                    <th class="weight-log__table-header-item">運動時間</th>
                    <th class="weight-log__table-header-item"></th>
                </tr>
                @foreach ($weightLogs as $log)
                <tr class="weight-log__table-row">
                    <td class="weight-log__table-cell">{{ $log->date }}</td>
                    <td class="weight-log__table-cell">{{ $log->weight ?? 'ーーー' }} kg</td>
                    <td class="weight-log__table-cell">{{ $log->calories ?? 'ーーー' }} cal</td>
                    <td class="weight-log__table-cell">{{ $log->exercise_time ?? 'ーーー' }}</td>
                    <td class="weight-log__table-cell">
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

    @endif
@endsection