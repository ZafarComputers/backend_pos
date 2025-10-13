<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create super admin
        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@example.com',
            'cell_no1' => '03001234567',
            'cell_no2' => null,
            'img_path' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        // Assign role ID 1
        $superAdmin->roles()->attach(1);

        // Create another admin
        $admin = User::create([
            'first_name' => 'Abdullah',
            'last_name' => 'Javed',
            'email' => 'majaved770@gmail.com',
            'cell_no1' => '03001234567',
            'cell_no2' => null,
            'img_path' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('jarmainkill'),
            'status' => 'active',
        ]);

        // Assign role ID 2
        $admin->roles()->attach(2);

        // Fetch all roles
        $roles = Role::all();

        // Create 8 random users and assign random roles
        User::factory(8)->create()->each(function ($user) use ($roles) {
            $randomRoles = $roles->random(rand(1, 2))->pluck('id')->toArray();
            $user->roles()->sync($randomRoles);
        });
    }
}
