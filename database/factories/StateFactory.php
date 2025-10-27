<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\State>
 */
class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => $this->faker->state,
            'state_code' => strtoupper($this->faker->lexify('??')),
            'country_id' => Country::factory(),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
