<?php

namespace Database\Factories;

use App\Models\PurchaseReturnDetail;
use App\Models\PurchaseReturn;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseReturnDetailFactory extends Factory
{
    protected $model = PurchaseReturnDetail::class;

    public function definition(): array
    {
        return [
            'purchase_return_id' => PurchaseReturn::inRandomOrder()->value('id'),
            'product_id' => Product::inRandomOrder()->value('id'),
            'qty' => $this->faker->numberBetween(1, 10),
            'pur_price' => $this->faker->randomFloat(2, 100, 2000),
        ];
    }
}
