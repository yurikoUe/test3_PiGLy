<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateWeightLogRequest;
use App\Http\Requests\GoalSettingRequest;
use Illuminate\Http\Request;

class WeightLogController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $targetWeight = $user->weightTarget->target_weight;

        // dateを基準に新しい順に並び替えたのち１番最初のレコードを取得
        $latestWeightLog = $user->weightLogs()->latest('date')->first();

        $weightLogs = $user->weightLogs()
            ->select('id','date', 'weight', 'calories', 'exercise_time')
            // 日付順に並び替え
            ->orderBy('date', 'desc')
            ->paginate(8);

        return view('weight_logs', compact('targetWeight', 'latestWeightLog', 'weightLogs'));
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $targetWeight = $user->weightTarget->target_weight;
        $latestWeightLog = $user->weightLogs()->latest('date')->first();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $weightLogs = WeightLog::query();

        if ($startDate && $endDate) {
            $weightLogs = $weightLogs->betweenDates($startDate, $endDate);
        }

        $weightLogs = $weightLogs->paginate(8);

        return view('weight_logs', compact('weightLogs','startDate', 'endDate', 'targetWeight', 'latestWeightLog'));
    }

    public function create(StoreWeightLogRequest $request)
    {
        $user = auth()->user();
        $targetWeight = $user->weightTarget->target_weight;

        // 新しい体重ログを追加
        $user->weightLogs()->create([
            'weight' => $request->weight,
            'date' => $request->date,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        // リダイレクトして、インデックスに遷移
        return redirect()->route('weight_logs');
    }

    public function showDetails($weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);
        return view('show_details', compact('log'));
    }

    public function update(UpdateWeightLogRequest $request, $weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);

        $log->date = $request->input('date');
        $log->weight = $request->input('weight');
        $log->calories = $request->input('calories');
        $log->exercise_time = $request->input('exercise_time');
        $log->exercise_content = $request->input('exercise_content');
        $log->save();

        // リダイレクトして、インデックスに遷移
        return redirect()->route('weight_logs');
    }

    public function destroy($weightLogId)
    {
        $user = auth()->user();
        $weightLog = $user->weightLogs()->findOrFail($weightLogId);

        $weightLog->delete();

        $targetWeight = $user->weightTarget->target_weight;
        $latestWeightLog = $user->weightLogs()->latest('date')->first();

        return redirect()->route('weight_logs', compact('targetWeight', 'latestWeightLog'));
    }

    public function goalSettingForm()
    {
        $user = auth()->user();
        $targetWeight = $user->weightTarget->target_weight;

        return view('goal_setting', compact('targetWeight'));
    }

    public function goalSetting(GoalSettingRequest $request)
    {
        $user = auth()->user();

        $targetWeight = $request->input('target_weight');

        if ($user->weightTarget) {
            $user->weightTarget->target_weight = $targetWeight;
            $user->weightTarget->save();
        } else {
            $user->weightTarget()->create([
                'target_weight' => $targetWeight
            ]);
        }

        return redirect()->route('weight_logs');
}

}
