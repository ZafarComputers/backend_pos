<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name'        => $this->faker->firstName,
            'last_name'         => $this->faker->lastName,
            'email'             => $this->faker->unique()->safeEmail(),
            'cell_no1'          => $this->faker->phoneNumber,
            'cell_no2'          => $this->faker->optional()->phoneNumber,
            'img_path'          => null,
            // 'role_id'           => optional(Role::inRandomOrder()->first())->id ?? 1,
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'status'            => 'active',
            'remember_token'    => Str::random(10),
        ];
    }
}
