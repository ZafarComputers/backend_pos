<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\PaymentMode;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        return [
            'transaction_type_id' => TransactionType::where('code', 'PT')->value('id')
                ?? TransactionType::inRandomOrder()->value('id')
                ?? TransactionType::factory(),

            'payment_mode_id' => PaymentMode::inRandomOrder()->value('id')
                ?? PaymentMode::factory(),

            'pur_date'         => $this->faker->date(),
            'vendor_id'        => Vendor::inRandomOrder()->value('id') ?? Vendor::factory(),
            'ven_inv_no'       => $this->faker->bothify('INV###'),
            'ven_inv_date'     => $this->faker->date(),
            'ven_inv_ref'      => $this->faker->lexify('REF???'),
            'pur_inv_barcode'  => $this->faker->ean13(),
            'description'      => $this->faker->sentence(),
            'discount_percent' => $this->faker->randomFloat(2, 0, 10),
            'discount_amt'     => $this->faker->randomFloat(2, 0, 500),
            'inv_amount'       => 0, // placeholder until details added
            'paid_amount'      => 0, // placeholder until details added
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Purchase $purchase) {
            $totalAmount = 0;

            // Get 1–4 random products to attach to this purchase
            $productIds = Product::inRandomOrder()
                ->limit(rand(1, 4))
                ->pluck('id');

            foreach ($productIds as $productId) {
                $detail = PurchaseDetail::factory()->make([
                    'purchase_id' => $purchase->id,
                    'product_id'  => $productId,
                ]);

                $detail->save();

                // Compute each line total
                $lineTotal = ($detail->qty * $detail->unit_price) - $detail->discAmount;
                $totalAmount += $lineTotal;

                // Update stock for each purchased product
                $product = Product::find($productId);
                if ($product) {
                    $product->increment('stock_in_quantity', $detail->qty);
                    $product->increment('in_stock_quantity', $detail->qty);
                }
            }

            // Update totals on purchase record
            $purchase->update([
                'inv_amount'  => number_format($totalAmount, 2, '.', ''),
                'paid_amount' => number_format($totalAmount, 2, '.', ''),
            ]);
        });
    }
}
