<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        $roles = Role::all();
        $users = User::all();

        // If no users exist, create some
        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        $users->each(function ($user) use ($roles) {
            $randomRoles = $roles->random(rand(1, 2))->pluck('id')->toArray();
            $user->roles()->sync($randomRoles);
        });
    }
}
