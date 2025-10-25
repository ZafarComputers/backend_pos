<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\FinanceAccount;
use App\Models\Sale;
use App\Models\Pos;
use App\Models\Purchase;
use App\Models\Expense;
use App\Models\Transaction;


class FinanceAccountApiController extends Controller
{
    /**
     * Trial Balance.
     */

    


    /**
     * Cash Flow.
     */


    /**
     * Account Statement.
     */



    /**
     * Profit & Loss Statement.
     */
    public function getProfitLossReport(Request $request)
    {
        $from = $request->query('from');
        $to   = $request->query('to');

        if (!$from || !$to) {
            return response()->json([
                'status' => false,
                'message' => 'Please provide both "from" and "to" date parameters.'
            ], 400);
        }

        try {
            // 🧾 SALES
            $sales = Pos::whereBetween('inv_date', [$from, $to])
                ->sum('inv_amount');

            // 📦 PURCHASES (COGS)
            $purchases = Purchase::whereBetween('inv_date', [$from, $to])
                ->sum('inv_amount');

            // 💸 EXPENSES
            $expenses = Expense::whereBetween('date', [$from, $to])
                ->sum('amount');

            // 🧮 GROSS & NET PROFIT
            $grossProfit = $sales - $purchases;
            $netProfit = $grossProfit - $expenses;

            // 📊 CATEGORY-WISE EXPENSE BREAKDOWN
            $expenseBreakdown = Expense::select(
                    'expense_category_id',
                    DB::raw('SUM(amount) as total')
                )
                ->whereBetween('date', [$from, $to])
                ->groupBy('expense_category_id')
                ->with('category:id,title') // assumes Expense::category() exists
                ->get()
                ->map(fn($e) => [
                    'category' => $e->category->title ?? 'Unknown',
                    'total' => (float) $e->total
                ]);

            // 💼 TRANSACTION SUMMARY (optional, good for finance teams)
            $transactions = Transaction::whereBetween('date', [$from, $to])
                ->selectRaw('
                    SUM(debit) as total_debit,
                    SUM(credit) as total_credit
                ')
                ->first();

            return response()->json([
                'status' => true,
                'message' => 'Profit & Loss report retrieved successfully.',
                'period' => [
                    'from' => $from,
                    'to' => $to,
                ],
                'summary' => [
                    'total_sales'     => (float) $sales,
                    'total_purchases' => (float) $purchases,
                    'total_expenses'  => (float) $expenses,
                    'gross_profit'    => (float) $grossProfit,
                    'net_profit'      => (float) $netProfit,
                ],
                'expense_breakdown' => $expenseBreakdown,
                'transaction_summary' => [
                    'total_debit'  => (float) ($transactions->total_debit ?? 0),
                    'total_credit' => (float) ($transactions->total_credit ?? 0),
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to generate Profit & Loss report.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
