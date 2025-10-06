<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        // create 10 purchases, each with 3 details
        Purchase::factory()
            ->count(10)
            ->has(PurchaseDetail::factory()->count(30), 'details')
            ->create([
            'payment_status' => 'unpaid', // or random if we prefer
        ]);
    }
}
