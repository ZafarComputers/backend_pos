<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PayIn;

class PayInSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 random PayOuts
        PayIn::factory()->count(10)->create();
    }
}
