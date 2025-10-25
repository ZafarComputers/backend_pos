<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'expense_category_id',
        'description',
        'date',
        'amount',
        'transaction_type_id',
        'payment_mode_id',
    ];

    /**
     * 🔗 Each expense belongs to a specific expense category.
     */
    public function category()
    {
        // return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
        return $this->belongsTo(Coa::class, 'expense_category_id');

    }

    /**
     * 🔗 Each expense is linked to a specific transaction type (e.g. Expense Transaction).
     */
    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    /**
     * 🔗 Each expense is paid through a payment mode (Cash, Bank, etc.).
     */
    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }

    /**
     * 🔗 Each expense can have multiple related transactions
     *     (debit & credit entries in the transactions table).
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'invRef_id')
                    ->where('transaction_types_id', 9); // ensure it only fetches Expense-related entries
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }
    
    public function payOut()
    {
        return $this->hasOne(PayOut::class, 'transaction_type_id', 'transaction_type_id');
    }   

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }   

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    
}