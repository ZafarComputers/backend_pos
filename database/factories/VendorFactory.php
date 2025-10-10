<?php

namespace Database\Factories;

use App\Models\City;   // <-- add this import
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    public function definition(): array {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email'             => $this->faker->unique()->safeEmail(),
            'cnic' => $this->faker->unique()->numerify('#####-#######-#'),
            'phone'          => $this->faker->phoneNumber,
            'address' => $this->faker->address(),
            'city_id' => City::inRandomOrder()->value('id'),
            // 'city_id' => City::inRandomOrder()->first()->id ?? City::factory(), // needs import
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
