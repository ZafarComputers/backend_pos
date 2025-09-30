<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CoaMainFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'Capital & Reserves',
                'Long Term Loans',
                'Deferred Liabilities',
                'Current Liabilities',
                'Fix Assets',
                'Long Term Assets',
                'Current Assets',
                'Revenues',
                'Admin Expenses'
            ]),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
