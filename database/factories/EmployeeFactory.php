<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cnic' => $this->faker->unique()->numerify('###########'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'city_id' => City::inRandomOrder()->first()?->id,
            'cell_no1' => $this->faker->phoneNumber(),
            'cell_no2' => $this->faker->optional()->phoneNumber(),
            'image_path' => null,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
