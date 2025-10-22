<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Super Admin', 
            'Admin',
            'Manager',
            'Cashier',
            'Inventory Officer',
            'Salesman',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
