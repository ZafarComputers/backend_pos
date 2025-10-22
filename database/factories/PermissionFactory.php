<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    public function definition(): array
    {
        // Define allowed prefixes
        $prefixes = [
            'Inventory',
            'Sales (POS)',
            'Purchase',
            'Finance and Accounts',
            'Reports',
            'Users',
        ];

        // Common actions for permissions
        $actions = ['View', 'Create', 'Edit', 'Delete', 'Approve', 'Manage'];

        // Randomly pick a prefix and action
        $prefix = $this->faker->randomElement($prefixes);
        $action = $this->faker->randomElement($actions);

        // Combine them (e.g., Inventory.View)
        $name = "{$prefix}.{$action}";

        return [
            'name' => $name,
            'slug' => Str::slug($name, '_'), // e.g. inventory_view
        ];
    }
}
