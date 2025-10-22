<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoaMain;
use App\Models\CoaSub;

class CoaSubSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Capital & Reserves' => [
                'Paid-Up Capitals (Share Holders)',
                'Revenues – Reserves',
            ],
            'Long Term Loans' => [
                'From Directors',
                'From Bank',
                'From Associated Company',
            ],
            'Deferred Liabilities' => [
                'Deferred Taxation',
                "Employee's Retirement Benefits",
            ],
            'Current Liabilities' => [
                'Bank Borrowing',
                'Trade Creditors for Supplies (A/c Payable)',
                'Trade Creditors for Sale Bases (A/c Payable)',
                'Trade Creditors for Services (A/c Payable)',
                'Accrued Liabilities',
                'Provision for Taxation',
            ],
            'Fix Assets' => [
                'Assets Owned (Fix Operating)',
                'Assets Leased (Fix Operating)',
                'Electric Installation',
                'Computers and Accessories',
                'Furniture and Fixtures',
                'Other Assets',
            ],
            'Long Term Assets' => [
                'Long Term Deposits',
            ],
            'Current Assets' => [
                'Cash Accounts',
                'Bank Accounts',
                'Short Term Advances',
                'Advances To Employees',
                'Advance Income Tax',
                'Stock in Trade',
                'Trade Debtors',
                'Account Receivables',
                'Refund',
            ],
            'Revenues' => [
                'Sales',
                'Cost of Sales',
            ],
            'Admin Expenses' => [
                'Utility Expense',
                'Rent Office',
                'Entertainment Expense',
                'Directors Remuneration',
                'Staff Salary and Benefits',
                'Rates and Taxes',
                'Communication Expenses',
                'Printing and Stationary',
                'Vehicle Running Expenses – POL',
                'Vehicle Repair and Maintenance',
                'Postage and Courier',
                'Legal and Professional Charges',
                'Travelling and Conveyance',
                'Miscellaneous Expenses',
                'Bank Charges',
                'Advertisement And Publicity',
                'Fee & Subscription',
                'Cleaning & Sanitation',
                'Charity & Welfare',
                'Website Expenses',
                'Internet Expenses',
            ],
        ];

        foreach ($data as $mainTitle => $subTitles) {
            $coaMain = CoaMain::where('title', $mainTitle)->first();
            if ($coaMain) {
                foreach ($subTitles as $title) {
                    CoaSub::create([
                        'title' => $title,
                        'coa_main_id' => $coaMain->id,
                        'status' => 'active',
                    ]);
                }
            }
        }
    }
}
