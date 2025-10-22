<?php

// database/seeders/CategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void {
        $categories = ['Bridal', 'Fancy', 'Casual'];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['title' => $cat],
                ['status' => 'Active', 'img_path' => null]
            );
        }
    }
}
