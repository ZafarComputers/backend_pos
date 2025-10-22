<?php

// database/seeders/SizeSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

class SizeSeeder extends Seeder
{
    public function run(): void {
        $sizes = ['Small', 'Medium', 'Large', 'Extra Large'];

        foreach ($sizes as $s) {
            Size::firstOrCreate(
                ['title' => $s],
                ['status' => 'Active']
            );
        }
    }
}
