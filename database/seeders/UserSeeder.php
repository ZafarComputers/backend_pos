<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        // 🟢 Create Super Admin (Role ID = 1)
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'first_name'        => 'Super',
                'last_name'         => 'Admin',
                'cell_no1'          => '03001234567',
                'cell_no2'          => null,
                'role_id'           => 1,
                'img_path'          => null,
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'status'            => 'active',
            ]
        );

        // 🟡 Create 5 demo users with roles 2 to 6
        foreach (range(2, 6) as $roleId) {
            User::factory()->create([
                'role_id' => $roleId,
            ]);
        }
    }
}
