<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Create some permissions
        $permissions = Permission::factory(8)->create();

        // Fetch all existing roles
        $roles = Role::all();

        // Assign random permissions to each role
        $roles->each(function ($role) use ($permissions) {
            $randomPermissions = $permissions->random(rand(3, 7))->pluck('id')->toArray();
            $role->permissions()->sync($randomPermissions);
        });
    }
}
