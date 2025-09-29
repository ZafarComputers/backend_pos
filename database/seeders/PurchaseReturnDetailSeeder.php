<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseReturnDetail;

class PurchaseReturnDetailSeeder extends Seeder
{
    public function run(): void
    {
        PurchaseReturnDetail::factory()->count(20)->create();
    }
}
