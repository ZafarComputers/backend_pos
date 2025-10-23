<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'cnic' => $this->faker->unique()->numerify('#####-#######-#'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),

            'city_id' => rand(1, 10),
            'cell_no1' => $this->faker->phoneNumber(),
            'cell_no2' => $this->faker->optional()->phoneNumber(),
            'image_path' => null,
            'role_id' => rand(2, 6),
            'status' => 1,
        ];
    }
}
