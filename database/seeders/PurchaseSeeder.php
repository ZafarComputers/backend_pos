<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        Purchase::factory()
            ->count(5)
            ->has(PurchaseDetail::factory()->count(3), 'details')
            ->create();
    }
}
