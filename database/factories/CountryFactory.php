<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
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
            'title' => $this->faker->country,
            'phone_code' => '+' . $this->faker->numberBetween(1, 999),
            'emoji_u' => 'U+1F1E6 U+1F1E8',
            'native' => $this->faker->word,
            'currency' => $this->faker->currencyCode(),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
