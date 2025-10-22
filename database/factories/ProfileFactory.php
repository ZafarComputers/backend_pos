<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'dob' => $this->faker->date(),
            'profile_picture' => null,
        ];
    }
}
