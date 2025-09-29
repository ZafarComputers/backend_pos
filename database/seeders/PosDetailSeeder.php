<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PosDetail;

class PosDetailSeeder extends Seeder
{
    public function run(): void
    {
        PosDetail::factory()->count(30)->create();
    }
}
