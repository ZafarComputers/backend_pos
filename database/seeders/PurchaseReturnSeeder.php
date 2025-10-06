<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetail;

class PurchaseReturnSeeder extends Seeder
{
    public function run(): void
    {
        PurchaseReturn::factory()
            ->count(10) // 10 purchase returns
            ->has(PurchaseReturnDetail::factory()->count(25), 'details') // each has 3 details
            ->create();
    }
}
