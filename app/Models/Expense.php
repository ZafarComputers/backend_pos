<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type_id', // ✅ new column
        'name',
        'expense_category_id',
        'description',
        'date',
        'amount',
        'payment_mode_id', // ✅ new column
    ];

    public function category()
    {
        // return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id', 'id');
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }

}
