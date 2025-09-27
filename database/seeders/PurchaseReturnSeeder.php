<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseReturn;

class PurchaseReturnSeeder extends Seeder
{
    public function run(): void
    {
        PurchaseReturn::factory()->count(10)->create();
    }
}
