<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーを1件作成
        $user = User::factory()->create();

        // ユーザーに紐づくWeightTargetを1件作成
        WeightTarget::factory()->create([
            'user_id' => $user->id,  // ユーザーのIDを関連付け
        ]);

        // ユーザーに紐づくWeightLogを35件作成
        WeightLog::factory(35)->create([
            'user_id' => $user->id,  // ユーザーのIDを関連付け
        ]);
    }
}
