<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pos;

class PosBankDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pos_id' => Pos::inRandomOrder()->value('id') ?? 1,
            'bank_name' => $this->faker->company(),
            'account_number' => $this->faker->bankAccountNumber(),
        ];
    }
}
