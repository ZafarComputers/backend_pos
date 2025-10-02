<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'design_code' => strtoupper($this->faker->bothify('DC###')),
            'image_path' => $this->faker->imageUrl(400, 400, 'product'),
            'sub_category_id' => SubCategory::factory(),
            'sale_price' => $this->faker->randomFloat(2, 50, 5000),
            'opening_stock_quantity' => $this->faker->numberBetween(1, 100),

            // If you already Have User and Vendor then this
            'user_id' => User::inRandomOrder()->first()->id,
            'vendor_id' => Vendor::inRandomOrder()->first()->id,

            // If you You do not have then this code (Yes: I have) 
            // 'user_id' => User::factory(),
            // 'vendor_id' => Vendor::factory(),             // ✅ Add vendor factory

            'barcode' => $this->faker->ean13,
            'qrcode' => $this->faker->url,               // Optional: add QR code
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
