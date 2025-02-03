<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\Register2Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 会員登録
    public function show_register_step1()
    {
        return view('auth.register_step1');
    }

    public function register_step1(RegisterRequest $request)
    {
        // DBに保存
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        ]);

         // ユーザーをログイン状態にする
        Auth::login($user);

        // 次の登録ステップへリダイレクト
        return redirect()->route('show.step2');
    }

    public function show_register_step2()
    {
        // 認証されていない場合はログイン画面にリダイレクト
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('auth.register_step2');
    }

    public function register_step2(Register2Request $request)
    {
        // ログインユーザーを取得
        $user = auth()->user();

        $user->weightLogs()->create([
            'weight' => $request->weight,
            'date' => now(),  // 現在の日付を保存
        ]);

        // 目標体重を保存（WeightTargetのリレーションを使う）
        $user->weightTarget()->create([
            'target_weight' => $request->target_weight,
        ]);
        
        // 管理画面に遷移
        return redirect()->route('weight_logs');

    }


    // ログイン
    public function show_login()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // フォームリクエストでバリデーションを通過した場合に認証を試みる
        if (Auth::attempt($request->only('email', 'password'))) {
            // 認証成功時のリダイレクト
            return redirect()->route('weight_logs');
        }

        // 認証失敗時のエラーメッセージをセッションに追加
        return back()->withErrors(['login' => 'ログイン情報が正しくありません。'])->withInput($request->only('email'));
    }

}
