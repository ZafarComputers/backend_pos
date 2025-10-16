<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            'Inventory',
            'Sales (POS)',
            'Purchase',
            'Finance and Accounts',
            'Reports',
            'Users',
        ];

        $actions = ['View', 'Create', 'Edit', 'Delete', 'Approve', 'Manage'];

        // Create permissions
        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $name = "{$module}.{$action}";
                Permission::firstOrCreate([
                    'name' => $name,
                    'guard_name' => 'web',
                ]);
            }
        }

        // Create roles
        $roles = ['Admin', 'Manager', 'Cashier', 'Viewer'];

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // Assign all permissions to Admin
        $adminRole = Role::where('name', 'Admin')->first();
        $adminRole->syncPermissions(Permission::all());
    }
}
