<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'cnic'       => $this->faker->numerify('#####-#######-#'),
            'cnic2'      => $this->faker->optional(0.7)->numerify('#####-#######-#'),
            'name'       => $this->faker->name,
            'name2'      => $this->faker->optional(0.5)->name,
            'email'      => $this->faker->unique()->safeEmail,
            'address'    => $this->faker->streetAddress . ', ' . $this->faker->city,
            'city_id'    => null, // overridden in seeder
            'cell_no1'   => '03' . $this->faker->randomElement(['0', '1', '2', '3', '4']) . $this->faker->numerify('########'),
            'cell_no2'   => $this->faker->optional(0.6)->regexify('03[0-4]{1}[0-9]{8}'),
            'cell_no3'   => $this->faker->optional(0.3)->regexify('03[0-4]{1}[0-9]{8}'),
            'image_path' => 'default.png',
            'status'     => 'active',
        ];
    }
}