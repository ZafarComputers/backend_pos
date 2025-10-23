<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    protected $fillable = ['coa_sub_id', 'code', 'title', 'type', 'status'];

    public function coaSub()
    {
        return $this->belongsTo(CoaSub::class);
    }

    /**
     * 🔗 A COA account may have many child accounts (hierarchical structure)
     */
    public function children()
    {
        return $this->hasMany(Coa::class, 'parent_id');
    }

    /**
     * 🔗 Each child COA belongs to a parent COA
     */
    public function parent()
    {
        return $this->belongsTo(Coa::class, 'parent_id');
    }

    /**
     * 🔗 This COA may be used in many transactions as the main account
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'coas_id');
    }

    /**
     * 🔗 This COA may also appear as the reference account in transactions (credit/debit pair)
     */
    public function referencedTransactions()
    {
        return $this->hasMany(Transaction::class, 'coaRef_id');
    }

    /**
     * 🔗 If this COA is tied to an expense category (e.g., “Rent Expense” → Expense COA)
     */
    public function expenseCategories()
    {
        return $this->hasMany(ExpenseCategory::class, 'coas_id');
    }

    /**
     * 🔗 Optional: You can also link directly to expenses (if you store coas_id there)
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Helper: Get balance for this account
     */
    public function getBalanceAttribute()
    {
        $debit = $this->transactions()->sum('debit');
        $credit = $this->transactions()->sum('credit');

        return $debit - $credit; // Positive = debit balance, Negative = credit balance
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }




}