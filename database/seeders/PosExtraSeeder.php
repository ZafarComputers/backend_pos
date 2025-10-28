<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pos;
use App\Models\PosDetail;
use App\Models\PosExtra;

class PosSeeder extends Seeder
{
    public function run(): void
    {
        // Generate multiple POS records
        Pos::factory()
            ->count(20)
            ->create()
            ->each(function ($pos) {

                // ✅ Create random POS details
                PosDetail::factory(rand(2, 5))->create([
                    'pos_id' => $pos->id,
                ]);

                // ✅ Create random extras for this POS
                PosExtra::factory(rand(1, 3))->create([
                    'pos_id' => $pos->id,
                ]);
            });
    }
}
