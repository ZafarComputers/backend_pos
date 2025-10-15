<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
