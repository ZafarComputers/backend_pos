<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PayOut;

class PayOutSeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 random PayOuts
        PayOut::factory()->count(10)->create();
    }
}
