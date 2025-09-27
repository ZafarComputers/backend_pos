<?php

// database/factories/UserFactory.php
namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'cell_no1' => $this->faker->phoneNumber,
            'cell_no2' => $this->faker->optional()->phoneNumber,
            'img_path' => $this->faker->imageUrl(100, 100, 'people'),
            'role_id' => Role::inRandomOrder()->first()?->id ?? Role::factory(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
