<?php

namespace Database\Factories;
use App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pos>
 */
class PosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inv_date' => $this->faker->date(),
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'tax' => $this->faker->randomFloat(2, 0, 100),
            'discPer' => $this->faker->randomFloat(2, 0, 20),
            'discAmount' => $this->faker->randomFloat(2, 0, 100),
            'inv_amount' => $this->faker->randomFloat(2, 10, 1000),
            'paid' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}

