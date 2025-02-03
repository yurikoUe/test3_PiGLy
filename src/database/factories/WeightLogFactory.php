<?php

namespace Database\Factories;

use App\Models\WeightLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    public function definition()
    {
        $user = User::first();

        return [
            'user_id' => $user->id,
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 40, 100), // 40kg～100kgの体重
            'calories' => $this->faker->numberBetween(100, 500), // カロリー
            'exercise_time' => $this->faker->time(),
            'exercise_content' => $this->faker->sentence(),
        ];
    }
}
