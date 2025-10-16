<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMode>
 */
class PaymentModeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'mode_name' => $this->faker->unique()->randomElement(['Cash', 'Bank', 'Credit']),
            'description' => $this->faker->sentence(),
            'status' => true,
        ];
    }
}
