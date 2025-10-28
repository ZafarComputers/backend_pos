<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pos;

class PosSeeder extends Seeder
{
    public function run(): void
    {
        // Create exactly ONE POS
        Pos::factory()
            ->count(1)
            ->create()
            ->each(function (Pos $pos) {
                // 1–3 details
                $pos->details()->saveMany(
                    \App\Models\PosDetail::factory()
                        ->count(rand(1, 3))
                        ->make()
                );
            });
    }
}