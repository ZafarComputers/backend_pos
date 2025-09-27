<?php

namespace Database\Factories;

use App\Models\PurchaseReturn;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseReturnFactory extends Factory
{
    protected $model = PurchaseReturn::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'vendor_id' => Vendor::inRandomOrder()->value('id'),
            'description' => $this->faker->sentence(),
            'product_id' => Product::inRandomOrder()->value('id'),
            'return_inv_amount' => $this->faker->randomFloat(2, 100, 2000),
            'purchase_id' => Purchase::inRandomOrder()->value('id'),
        ];
    }
}
