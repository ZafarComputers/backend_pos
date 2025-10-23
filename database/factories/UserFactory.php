<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name'        => $this->faker->firstName,
            'last_name'         => $this->faker->lastName,
            'email'             => $this->faker->unique()->safeEmail,
            'cell_no1'          => $this->faker->phoneNumber,
            'cell_no2'          => null,
            'role_id'           => 4, // default: normal user
            'img_path'          => null,
            'email_verified_at' => now(),
            'password'          => bcrypt('password'), // default password
            'status'            => 'active',
            'remember_token'    => Str::random(10),
        ];
    }
}