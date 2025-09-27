<?php

// database/factories/SubCategoryFactory.php
namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    protected $model = SubCategory::class;

    public function definition(): array {
        $map = [
            'Bridal' => ['Lahnga', 'Maxi', 'LongShirt'],
            'Fancy' => ['Sharara', 'Garara', 'Shalwar Kameez', 'Lahga Choli'],
            'Casual' => ['Readymade', 'Unstitched'],
        ];

        static $items;
        if (!$items) {
            $items = [];
            foreach ($map as $cat => $subs) {
                $category = Category::where('title', $cat)->first();
                if ($category) {
                    foreach ($subs as $sub) {
                        $items[] = ['title' => $sub, 'category_id' => $category->id];
                    }
                }
            }
        }

        $pick = array_shift($items) ?? ['title' => 'Undefined', 'category_id' => Category::inRandomOrder()->value('id')];

        return [
            'title' => $pick['title'],
            'img_path' => $this->faker->imageUrl(200, 200, 'fashion', true),
            'category_id' => $pick['category_id'],
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
