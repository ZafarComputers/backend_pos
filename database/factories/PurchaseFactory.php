<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        return [
            'pur_date'         => $this->faker->date(),
            'vendor_id'        => Vendor::inRandomOrder()->value('id'),
            'ven_inv_no'       => $this->faker->bothify('INV###'),
            'ven_inv_date'     => $this->faker->date(),
            'ven_inv_ref'      => $this->faker->lexify('REF???'),
            'pur_inv_barcode'  => $this->faker->ean13(),
            'description'      => $this->faker->sentence(),
            'discount_percent' => $this->faker->randomFloat(2, 0, 10),
            'discount_amt'     => $this->faker->randomFloat(2, 0, 500),
            'inv_amount'       => $this->faker->randomFloat(2, 1000, 5000),
            'payment_status'   => $this->faker->randomElement(['Paid', 'Unpaid', 'Overdue']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Purchase $purchase) {
            // Pick 1–4 random distinct products
            $productIds = Product::inRandomOrder()
                ->limit(rand(1, 4))
                ->pluck('id');

            foreach ($productIds as $productId) {
                // Create a purchase detail for each selected product
                $detail = PurchaseDetail::factory()->create([
                    'purchase_id' => $purchase->id,
                    'product_id'  => $productId,
                ]);

                // 🟢 Update that product's stock_in_quantity
                $product = Product::find($productId);

                if ($product) {
                    $product->increment('stock_in_quantity', $detail->qty);
                    $product->increment('in_stock_quantity', $detail->qty);
                }
            }
        });
    }
}
