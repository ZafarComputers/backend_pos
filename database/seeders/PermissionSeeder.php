<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $prefixes = [
            'Inventory',
            'Sales (POS)',
            'Purchase',
            'Finance and Accounts',
            'Reports',
            'Users',
        ];

        $actions = ['View', 'Create', 'Edit', 'Delete', 'Approve', 'Manage'];

        foreach ($prefixes as $prefix) {
            foreach ($actions as $action) {
                $name = "{$prefix}.{$action}";
                Permission::updateOrCreate(
                    ['slug' => Str::slug($name, '_')],
                    ['name' => $name]
                );
            }
        }
    }
}
