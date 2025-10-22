<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CoaMainFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'Capital & Reserves (Equity)',
                'Current Assets',
                'Fix Assets',
                'Current Liabilities',
                'Revenues',
                'Administrative Expenses'
            ]),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
