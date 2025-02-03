<?php

namespace Database\Factories;

use App\Models\WeightTarget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
    protected $model = WeightTarget::class;

    public function definition()
    {
        $user = User::first();
        
        return [
            'user_id' => $user->id,
            'target_weight' => $this->faker->randomFloat(1, 40, 100), // 40kg～100kgの目標体重
        ];
    }
}
