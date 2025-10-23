<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // --- Roles ---
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Full access'],
            ['name' => 'Manager', 'slug' => 'manager', 'description' => 'Manage operations'],
            ['name' => 'Cashier', 'slug' => 'cashier', 'description' => 'Handles sales'],
            ['name' => 'HR', 'slug' => 'hr', 'description' => 'Manages employees'],
            ['name' => 'Inventory', 'slug' => 'inventory', 'description' => 'Manages stock'],
            ['name' => 'Viewer', 'slug' => 'viewer', 'description' => 'View-only access'],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(['slug' => $roleData['slug']], $roleData);
        }

        // --- Permissions ---
        $permissions = [
            ['name' => 'Manage Users', 'slug' => 'manage_users', 'description' => 'Create, edit, delete users'],
            ['name' => 'View Reports', 'slug' => 'view_reports', 'description' => 'View system reports'],
            ['name' => 'Manage Vendors', 'slug' => 'manage_vendors', 'description' => 'CRUD vendor records'],
            ['name' => 'Manage Attendance', 'slug' => 'manage_attendance', 'description' => 'View and update attendance'],
            ['name' => 'Manage Inventory', 'slug' => 'manage_inventory', 'description' => 'CRUD products and stock'],
        ];

        foreach ($permissions as $permData) {
            Permission::firstOrCreate(['slug' => $permData['slug']], $permData);
        }

        // --- Assign permissions to roles ---
        $admin = Role::where('slug', 'admin')->first();
        $manager = Role::where('slug', 'manager')->first();
        $cashier = Role::where('slug', 'cashier')->first();

        $admin->permissions()->sync(Permission::pluck('id')); // all permissions
        $manager->permissions()->sync(Permission::whereIn('slug', ['view_reports', 'manage_vendors', 'manage_inventory'])->pluck('id'));
        $cashier->permissions()->sync(Permission::whereIn('slug', ['manage_inventory'])->pluck('id'));
    }
}
