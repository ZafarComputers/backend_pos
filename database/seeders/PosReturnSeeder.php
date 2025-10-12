<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PosReturn;

class PosReturnSeeder extends Seeder
{
    public function run(): void
    {
        PosReturn::factory()->count(15)->create();
    }
}
