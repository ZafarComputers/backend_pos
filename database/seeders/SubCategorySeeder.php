<?php

// database/seeders/SubCategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    public function run(): void {
        $map = [
            'Bridal' => ['Lahnga', 'Maxi', 'LongShirt'],
            'Fancy' => ['Sharara', 'Garrara', 'Shalwar Kameez', 'Lahnga Choli'],
            'Casual' => ['Readymade', 'Unstitched'],
        ];

        foreach ($map as $cat => $subs) {
            $category = Category::where('title', $cat)->first();
            if ($category) {
                foreach ($subs as $sub) {
                    SubCategory::firstOrCreate(
                        ['title' => $sub, 'category_id' => $category->id],
                        ['status' => 'Active', 'img_path' => null]
                    );
                }
            }
        }
    }
}
