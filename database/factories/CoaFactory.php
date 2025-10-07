<?php

namespace Database\Factories;

use App\Models\Coa;
use App\Models\CoaSub;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoaFactory extends Factory
{
    protected $model = Coa::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'coa_sub_id' => CoaSub::factory(),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
