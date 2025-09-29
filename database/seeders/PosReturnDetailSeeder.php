<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PosReturnDetail;

class PosReturnDetailSeeder extends Seeder
{
    public function run(): void
    {
        PosReturnDetail::factory()->count(20)->create();
    }
}
