<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'Anarkali', 'Banarci', 'Maxi', 'Long Shirt'
            ]),
            'design_code' => strtoupper($this->faker->bothify('DC###')),
            'image_path' => $this->faker->imageUrl(640, 480, 'fashion'),
            'sub_category_id' => SubCategory::inRandomOrder()->value('id'),
            'sale_price' => $this->faker->randomFloat(2, 1000, 5000),
            'opening_stock_quantity' => $this->faker->numberBetween(5, 50),
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'barcode' => $this->faker->unique()->ean13(),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
