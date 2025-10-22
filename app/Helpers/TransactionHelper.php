<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class TransactionHelper
{
    /**
     * Create double-entry transactions
     *
     * @param  string  $date
     * @param  int  $refId
     * @param  int  $transactionTypeId
     * @param  int  $debitCoaId
     * @param  int  $creditCoaId
     * @param  int  $userId
     * @param  string|null  $description
     * @param  float  $amount
     */
    public static function createDoubleEntry(
        $date,
        $refId,
        $transactionTypeId,
        $debitCoaId,
        $creditCoaId,
        $userId,
        $description,
        $amount
    ) {
        // ✅ Debit Entry
        Transaction::create([
            'date' => $date,
            'invRef_id' => $refId,
            'transaction_types_id' => $transactionTypeId,
            'coas_id' => $debitCoaId,
            'coaRef_id' => $creditCoaId,
            // 'users_id' => $userId,
            'users_id' => Auth::id() ?? 1,           // 👈 fallback to user ID 1
            'description' => $description,
            'debit' => $amount,
            'credit' => 0,
        ]);

        // ✅ Credit Entry
        Transaction::create([
            'date' => $date,
            'invRef_id' => $refId,
            'transaction_types_id' => $transactionTypeId,
            'coas_id' => $creditCoaId,
            'coaRef_id' => $debitCoaId,
            // 'users_id' => $userId,
            'users_id' => Auth::id() ?? 1,           // 👈 fallback to user ID 1
            'description' => $description,
            'debit' => 0,
            'credit' => $amount,
        ]);
    }
}
