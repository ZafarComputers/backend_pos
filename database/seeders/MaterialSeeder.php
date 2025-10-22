<?php

// database/seeders/MaterialSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run(): void {
        $materials = ['Cotton', 'Silk', 'Linen', 'Wool', 'Denim', 'Polyester', 'Fabric'];

        foreach ($materials as $m) {
            Material::firstOrCreate(
                ['title' => $m],
                ['status' => 'Active']
            );
        }
    }
}
