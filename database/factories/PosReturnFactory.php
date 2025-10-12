<?php

namespace Database\Factories;

use App\Models\Pos;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PosReturnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // pick random existing IDs
            'customer_id' => Customer::inRandomOrder()->value('id') ?? Customer::factory(),
            'pos_id' => Pos::inRandomOrder()->value('id'), // use existing POS record
            'invRet_date' => $this->faker->date(),
            'return_inv_amout' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}
