<?php

namespace Database\Seeders;

// use App\Models\User0;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User0::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CountrySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            EmployeeSeeder::class,
            VendorSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            SeasonSeeder::class,
            MaterialSeeder::class,
            ProductSeeder::class,
            PurchaseSeeder::class,
            PurchaseReturnSeeder::class,
        ]);


    }
}
