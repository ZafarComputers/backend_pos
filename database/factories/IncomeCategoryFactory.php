<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'income_category' => $this->faker->word(),
            'date' => $this->faker->date(),
        ];
    }
}
