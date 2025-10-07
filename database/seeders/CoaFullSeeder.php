<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoaMain;
use App\Models\CoaSub;
use App\Models\Coa;

class CoaFullSeeder extends Seeder
{
    public function run(): void
    {
        // 🧩 Hierarchical COA data: Main → Sub → Coa titles
        $coaData = [
            'Capital & Reserves' => [
                'Paid-Up Capitals (Share Holders)' => ['Mr. Test', 'Mr. Test2'],
                'Revenues - Reserves' => ['Profit & Loss A/C (o/Bal)'],
            ],

            'Current Liabilities' => [
                'Trade Creditors for Services (A/c Payable)' => ['TCS Courier Service', 'Naya Tel'],
                'Accrued Liabilities' => ['Petty Cash', 'Salaries Payable', 'Office Rent Payable'],
            ],

            'Fixed Assets' => [
                'Assets Owned (Fix Operating)' => ['Furniture & Fixtures', 'Computers', 'Office Equipment\'s'],
                'Long Term Deposits' => ['Security Deposits', 'Advance Rent'],
            ],
        ];

        foreach ($coaData as $mainTitle => $subGroups) {

            // 1️⃣ Create Main
            $coaMain = CoaMain::create([
                'title' => $mainTitle,
                'status' => 'Active',
            ]);

            // 2️⃣ Loop through Subgroups
            foreach ($subGroups as $subTitle => $coaTitles) {

                // Create Sub
                $coaSub = CoaSub::create([
                    'title' => $subTitle,
                    'coa_main_id' => $coaMain->id,
                    'status' => 'Active',
                ]);

                // 3️⃣ Loop through Coa entries for each Sub
                foreach ($coaTitles as $coaTitle) {
                    Coa::create([
                        'title' => $coaTitle,
                        'coa_sub_id' => $coaSub->id,
                        'status' => 'Active',
                    ]);
                }
            }
        }

        echo "✅ COA hierarchy seeded successfully!\n";
    }
}
