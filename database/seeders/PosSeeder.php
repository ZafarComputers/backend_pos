<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pos;

class PosSeeder extends Seeder
{
    public function run(): void
    {
        Pos::factory()->count(20)->create();
    }
}
