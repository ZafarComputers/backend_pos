<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// Resources
use App\Http\Resources\FinanceAccount\CashFlowResource;
use App\Http\Resources\FinanceAccount\TransactionResource;

// Models
use App\Models\FinanceAccount;
use App\Models\Coa;
use App\Models\Sale;
use App\Models\Pos;
use App\Models\Purchase;
use App\Models\Expense;
use App\Models\Transaction;



class FinanceAccountApiController extends Controller
{
    /**
     * Display Cash Flow combining all related tables.
     */
    public function cashFlow(Request $request)
    {
        // ✅ Fetch only coas_id = 3 or 4
            $transactions = Transaction::whereIn('coas_id', [3, 4])
                ->orderBy('date', 'desc')
                ->get();

            // ✅ Return JSON with Resource collection (recommended)
            return response()->json([
                'status' => true,
                'message' => 'Cash flow data retrieved successfully.',
                'data' => TransactionResource::collection($transactions),
            ]);
            
    }


    public function accountStatement(Request $request)
    {
        // Validate input parameters
        $validated = $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'account_id' => 'nullable|integer|exists:coas,id',
        ]);

        // Build the query for transactions
        $query = Transaction::query()
            ->with('transactionType'); // Assuming Transaction model has belongsTo relation to TransactionType

        // Filter by account if provided
        if ($request->account_id) {
            $query->where('coas_id', $request->account_id);
            $account = Coa::find($request->account_id);
            $accountName = $account ? $account->name . ' - ' . $account->account_number : 'Unknown Account';
        } else {
            $accountName = 'All Accounts';
        }

        // Apply date filters with current date as default 'to'
        $fromDate = $request->from ?? Transaction::min('date'); // Default to earliest date if no 'from'
        $toDate = $request->to ?? date('Y-m-d'); // Default to today, October 18, 2025
        $query->whereBetween('date', [$fromDate, $toDate]);

        // Calculate opening balance (sum of (credit - debit) before the 'from' date)
        $openingQuery = Transaction::select(DB::raw('SUM(credit - debit) as opening_balance'));
        if ($request->account_id) {
            $openingQuery->where('coas_id', $request->account_id);
        }
        $openingQuery->where('date', '<', $fromDate);
        $openingBalance = $openingQuery->value('opening_balance') ?? 0;

        // Fetch transactions ordered by date ascending for balance calculation
        $transactions = $query->orderBy('date', 'asc')
            ->orderBy('id', 'asc') // Secondary sort by ID for consistency
            ->get();

        // Calculate running balances and additional fields
        $currentBalance = $openingBalance;
        $formattedTransactions = [];
        foreach ($transactions as $transaction) {
            $delta = $transaction->credit - $transaction->debit;
            $currentBalance += $delta;

            $formattedTransactions[] = [
                'reference_number' => '#AS' . str_pad($transaction->id, 3, '0', STR_PAD_LEFT), // Generated reference
                'date' => $transaction->date,
                'category' => $transaction->transactionType->name ?? 'Uncategorized',
                'description' => $transaction->description ?? '',
                'amount' => $delta >= 0 ? '+' . $transaction->credit : '-' . abs($transaction->debit),
                'transaction_type' => $delta >= 0 ? 'Credit' : 'Debit',
                'balance' => $currentBalance,
            ];
        }

        // Reverse the array to show latest first (as in the image)
        $formattedTransactions = array_reverse($formattedTransactions);

        // Prepare the response
        $response = [
            'account_statement' => [
                'account_name' => $accountName,
                'from_date' => $fromDate,
                'to_date' => $toDate,
                'opening_balance' => $openingBalance,
                'transactions' => $formattedTransactions,
            ],
        ];

        return response()->json($response);
    }


    public function accountStatementById(Request $request, $id)
    {
        // Validate input parameters (only dates now)
        $validated = $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);

        // Get the account
        $account = Coa::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        $accountName = $account->name . ' - ' . $account->account_number;

        // Apply date filters with current date as default 'to'
        $fromDate = $request->from ?? Transaction::where('coas_id', $id)->min('date'); // Earliest date for this account
        $toDate = $request->to ?? date('Y-m-d'); // Default to today

        // Build the query for transactions of this account
        $transactions = Transaction::with('transactionType')
            ->where('coas_id', $id)
            ->whereBetween('date', [$fromDate, $toDate])
            ->orderBy('date', 'asc')
            ->orderBy('id', 'asc') // Secondary sort
            ->get();

        // Calculate opening balance before 'from' date
        $openingBalance = Transaction::where('coas_id', $id)
            ->where('date', '<', $fromDate)
            ->sum(DB::raw('credit - debit'));

        // Calculate running balances and format transactions
        $currentBalance = $openingBalance;
        $formattedTransactions = [];
        foreach ($transactions as $transaction) {
            $delta = $transaction->credit - $transaction->debit;
            $currentBalance += $delta;

            $formattedTransactions[] = [
                'reference_number' => '#AS' . str_pad($transaction->id, 3, '0', STR_PAD_LEFT),
                'date' => $transaction->date,
                'category' => $transaction->transactionType->name ?? 'Uncategorized',
                'description' => $transaction->description ?? '',
                'amount' => $delta >= 0 ? '+' . $transaction->credit : '-' . abs($transaction->debit),
                'transaction_type' => $delta >= 0 ? 'Credit' : 'Debit',
                'balance' => $currentBalance,
            ];
        }

        // Reverse to show latest first
        $formattedTransactions = array_reverse($formattedTransactions);

        // Prepare response
        $response = [
            'account_statement' => [
                'account_name' => $accountName,
                'from_date' => $fromDate,
                'to_date' => $toDate,
                'opening_balance' => $openingBalance,
                'transactions' => $formattedTransactions,
            ],
        ];

        return response()->json($response);
    }

    public function accountStatementByDate(Request $request, $accountId)
    {
        // Validate date inputs
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);

        // Get the account
        $account = Coa::find($accountId);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        $accountName = $account->name . ' - ' . $account->account_number;

        // Determine date range
        if ($request->from && $request->to) {
            $fromDate = $request->from;
            $toDate = $request->to;
        } elseif ($request->from) {
            // Single date filter
            $fromDate = $toDate = $request->from;
        } else {
            $fromDate = Transaction::where('coas_id', $accountId)->min('date');
            $toDate = date('Y-m-d');
        }

        // Get transactions for account within date range
        $transactions = Transaction::with('transactionType')
            ->where('coas_id', $accountId)
            ->whereBetween('date', [$fromDate, $toDate])
            ->orderBy('date', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        // Calculate opening balance before 'from' date
        $openingBalance = Transaction::where('coas_id', $accountId)
            ->where('date', '<', $fromDate)
            ->sum(DB::raw('credit - debit'));

        // Format transactions and calculate running balance
        $currentBalance = $openingBalance;
        $formattedTransactions = [];
        foreach ($transactions as $transaction) {
            $delta = $transaction->credit - $transaction->debit;
            $currentBalance += $delta;

            $formattedTransactions[] = [
                'reference_number' => '#AS' . str_pad($transaction->id, 3, '0', STR_PAD_LEFT),
                'date' => $transaction->date,
                'category' => $transaction->transactionType->name ?? 'Uncategorized',
                'description' => $transaction->description ?? '',
                'amount' => $delta >= 0 ? '+' . $transaction->credit : '-' . abs($transaction->debit),
                'transaction_type' => $delta >= 0 ? 'Credit' : 'Debit',
                'balance' => $currentBalance,
            ];
        }

        // Reverse for latest first
        $formattedTransactions = array_reverse($formattedTransactions);

        // Prepare response
        return response()->json([
            'account_statement' => [
                'account_name' => $accountName,
                'from_date' => $fromDate,
                'to_date' => $toDate,
                'opening_balance' => $openingBalance,
                'transactions' => $formattedTransactions,
            ],
        ]);
    }


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
            $purchases = Purchase::whereBetween('pur_date', [$from, $to])
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
                ->with('category:id,category') // assumes Expense::category() exists
                ->get()
                ->map(fn($e) => [
                    'category' => $e->category->category ?? 'Unknown',
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
