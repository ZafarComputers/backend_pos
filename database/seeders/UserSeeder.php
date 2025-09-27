<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@example.com',
            'cell_no1' => '03001234567',
            'cell_no2' => null,
            'img_path' => null,
            'role_id' => 1, // Super Admin role ID
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        User::factory(10)->create();
    }
}
