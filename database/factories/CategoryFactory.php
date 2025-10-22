<?php

// database/factories/CategoryFactory.php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array {
        $titles = ['Bridal', 'Fancy', 'Casual'];

        // Pick one of the fixed categories only
        static $i = 0;
        $title = $titles[$i % count($titles)];
        $i++;

        return [
            'title' => $title,
            'img_path' => $this->faker->imageUrl(200, 200, 'fashion', true),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
