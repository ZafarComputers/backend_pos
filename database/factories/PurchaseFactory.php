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
            'inv_amount'       => 0, // placeholder
            'paid_amount'      => 0, // placeholder
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Purchase $purchase) {
            // 🧹 Ensure total resets per invoice
            $totalAmount = 0;

            // 🧩 Limit to 1–4 random products only
            $productIds = Product::inRandomOrder()
                ->limit(rand(1, 4))
                ->pluck('id');

            foreach ($productIds as $productId) {
                // ✅ Create detail manually — not calling nested factories
                $detail = PurchaseDetail::factory()->make([
                    'purchase_id' => $purchase->id,
                    'product_id'  => $productId,
                ]);

                // Save manually so we don’t trigger its own internal loop
                $detail->save();

                // Calculate line total
                $lineAmount = ($detail->qty * $detail->unit_price) - $detail->discAmount;
                $totalAmount += $lineAmount;

                // Update product stock
                $product = Product::find($productId);
                if ($product) {
                    $product->increment('stock_in_quantity', $detail->qty);
                    $product->increment('in_stock_quantity', $detail->qty);
                }
            }

            // ✅ Now update invoice totals (this invoice only)
            $purchase->update([
                'inv_amount'  => number_format($totalAmount, 2, '.', ''),
                'paid_amount' => number_format($totalAmount, 2, '.', ''),
            ]);
        });
    }
}
