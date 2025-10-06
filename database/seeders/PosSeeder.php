<?php

namespace Database\Seeders;

use App\Models\Pos;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\PosDetail;

class PosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pos::factory(3)->create()->each(function ($pos) {
            $pos->posDetails()->saveMany(PosDetail::factory(3)->make());
        });
    }
}