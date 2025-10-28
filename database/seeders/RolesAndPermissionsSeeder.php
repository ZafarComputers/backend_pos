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
            ['name' => 'Super Admin', 'slug' => 'super_admin', 'description' => 'Full access'],
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Full access'],
            ['name' => 'Manager', 'slug' => 'manager', 'description' => 'Manage operations'],
            ['name' => 'Cashier', 'slug' => 'cashier', 'description' => 'Handles sales'],
            ['name' => 'Inventory Officer', 'slug' => 'inventory_officer', 'description' => 'Manages stock'],
            ['name' => 'Salesman', 'slug' => 'salesman', 'description' => 'POS access'],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(['slug' => $roleData['slug']], $roleData);
        }

        // --- Permissions ---
        $permissions = [
            ['name' => 'View Reports', 'slug' => 'view_reports', 'description' => 'View system reports'],
            ['name' => 'Manage Vendors', 'slug' => 'manage_vendors', 'description' => 'CRUD vendor records'],
            ['name' => 'Manage Attendance', 'slug' => 'manage_attendance', 'description' => 'View and update attendance'],
            ['name' => 'Manage Inventory', 'slug' => 'manage_inventory', 'description' => 'CRUD products and stock'],
            ['name' => 'Manage Users', 'slug' => 'manage_users', 'description' => 'Create, edit, and delete users'],
            ['name' => 'Sales POS', 'slug' => 'sales_pos', 'description' => 'Handle POS sales transactions'],
        ];

        foreach ($permissions as $permData) {
            Permission::firstOrCreate(['slug' => $permData['slug']], $permData);
        }

        // --- Assign permissions to roles ---
        $superAdmin = Role::where('slug', 'super_admin')->first();
        $admin      = Role::where('slug', 'admin')->first();
        $manager    = Role::where('slug', 'manager')->first();
        $cashier    = Role::where('slug', 'cashier')->first();
        $inventory  = Role::where('slug', 'inventory_officer')->first();
        $salesman   = Role::where('slug', 'salesman')->first();

        // Assign permissions
        if ($superAdmin) {
            $superAdmin->permissions()->sync(Permission::pluck('id')); // full access
        }

        if ($admin) {
            $admin->permissions()->sync(Permission::pluck('id')); // full access
        }

        if ($manager) {
            $manager->permissions()->sync(
                Permission::whereIn('slug', [
                    'view_reports',
                    'manage_vendors',
                    'manage_inventory',
                    'manage_attendance'
                ])->pluck('id')
            );
        }

        if ($cashier) {
            $cashier->permissions()->sync(
                Permission::whereIn('slug', [
                    'sales_pos',
                    'manage_inventory'
                ])->pluck('id')
            );
        }

        if ($inventory) {
            $inventory->permissions()->sync(
                Permission::whereIn('slug', [
                    'manage_inventory'
                ])->pluck('id')
            );
        }

        if ($salesman) {
            $salesman->permissions()->sync(
                Permission::whereIn('slug', [
                    'sales_pos'
                ])->pluck('id')
            );
        }
    }
}
