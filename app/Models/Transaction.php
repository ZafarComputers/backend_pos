<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'transaction_type_id',
        'invRef_id',
        'coas_id',
        'coaRef_id',
        'description',
        'debit',
        'credit',
        'users_id',
    
    ];

    // Relations (optional)
    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    // public function transactionType()
    // {
    //     return $this->belongsTo(TransactionType::class, 'transaction_types_id');
    // }

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * 🔗 The reference COA (the opposite account in double entry)
     */
    public function coaRef()
    {
        return $this->belongsTo(Coa::class, 'coaRef_id');
    }

    /**
     * 🔗 This transaction may belong to an Expense
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class, 'invRef_id');
    }

    /**
     * 🔗 This transaction may belong to a Purchase
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'invRef_id');  
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }


}