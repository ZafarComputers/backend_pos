<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cnic' => $this->faker->unique()->numerify('#####-#######-#'),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->streetAddress . ', ' . $this->faker->city,
            'city_id' => null, // overridden in seeder
            'cell_no1' => '03' . $this->faker->randomElement(['0','1','2','3','4']) . $this->faker->numerify('########'),
            'cell_no2' => $this->faker->optional(0.6)->regexify('03[0-4][0-9]{8}'),
            'image_path' => 'employees/default.png',
            'role_id' => null, // overridden
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}