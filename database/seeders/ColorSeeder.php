<?php

// database/seeders/ColorSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    public function run(): void {
        $colors = ['Red', 'Blue', 'Green', 'Yellow', 'Black', 'White'];

        foreach ($colors as $c) {
            Color::firstOrCreate(
                ['title' => $c],
                ['status' => 'Active']
            );
        }
    }
}

