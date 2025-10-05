<?php

namespace Database\Factories;

use App\Models\PurchaseDetail;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseDetailFactory extends Factory
{
    protected $model = PurchaseDetail::class;

    public function definition(): array
    {
        return [
            'purchase_id' => Purchase::factory(), // auto create purchase if not provided
            'product_id' => Product::factory(),   // auto create product if not provided
            'qty' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 100, 1000),
            'discPer' => $this->faker->randomFloat(2, 0, 10),
            'discAmount' => $this->faker->randomFloat(2, 0, 200),
        ];
    }
}
