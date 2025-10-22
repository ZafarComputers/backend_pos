<?php

namespace Database\Factories;

use App\Models\PurchaseDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class PurchaseDetailFactory extends Factory
{
    protected $model = PurchaseDetail::class;

    public function definition(): array
    {
        $qty       = $this->faker->numberBetween(1, 10);
        $unitPrice = $this->faker->randomFloat(2, 100, 500);
        $discPer   = $this->faker->randomFloat(2, 0, 10);
        $discAmt   = ($unitPrice * $qty * $discPer) / 100;

        return [
            'product_id'  => Product::inRandomOrder()->value('id'), // ✅ pick existing product
            'qty'         => $qty,
            'unit_price'  => $unitPrice,
            'discPer'     => $discPer,
            'discAmount'  => $discAmt,
        ];
    }
}
