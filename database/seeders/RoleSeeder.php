<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Super Admin', 
            'Admin',
            'Manager',
            'Cashier',
            'Inventory Officer',
            'Salesman',
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => Str::slug($role)],
                ['name' => $role]
            );
        }
    }
}
