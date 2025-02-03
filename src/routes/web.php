<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalSettingController;
use App\Http\Controllers\AuthController;

// 会員登録
Route::get('/register/step1', [AuthController::class, 'show_register_step1'])->name('show.step1');
Route::post('/register/step1', [AuthController::class, 'register_step1'])->name('register.step1');
Route::get('/register/step2', [AuthController::class, 'show_register_step2'])->middleware('auth')->name('show.step2');
Route::post('/register/step2', [AuthController::class, 'register_step2'])->name('register.step2');

//ログイン・ログアウト
Route::get('/login', [AuthController::class, 'show_login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 会員コンテンツ
Route::middleware(['auth'])->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs');
    Route::get('/weight_logs/search', [WeightLogController::class, 'search']);
    Route::post('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalSettingForm'])->name('goal_setting_form');
    Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting'])->name('goal_setting');

    Route::post('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.delete');
    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'showDetails'])->name('weight_logs.details');
});


