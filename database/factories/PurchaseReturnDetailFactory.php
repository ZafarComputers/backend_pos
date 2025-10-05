<?php

namespace Database\Factories;

use App\Models\PurchaseReturnDetail;
use App\Models\PurchaseReturn;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseReturnDetailFactory extends Factory
{
    protected $model = PurchaseReturnDetail::class;

    public function definition()
    {
        $qty = $this->faker->numberBetween(1, 10);
        $unitPrice = $this->faker->randomFloat(2, 50, 500);
        $discPer = $this->faker->numberBetween(0, 20);
        $discAmount = ($unitPrice * $qty) * ($discPer / 100);

        return [
            'purchase_return_id' => PurchaseReturn::factory(),
            'product_id' => Product::factory(),
            'qty' => $qty,
            'unit_price' => $unitPrice,
            'discPer' => $discPer,
            'discAmount' => $discAmount,
        ];
    }
}
