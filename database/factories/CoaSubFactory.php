<?php

namespace Database\Factories;

use App\Models\CoaMain;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoaSubFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'coa_main_id' => CoaMain::inRandomOrder()->first()?->id ?? CoaMain::factory(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
