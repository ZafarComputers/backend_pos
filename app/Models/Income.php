<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type_id',
        'date',
        'income_category_id',
        'incm_cat_name',
        'notes',
        'amount',
    ];

    // public function category()
    // {
    //     return $this->belongsTo(IncomeCategory::class, 'income_category_id');
    // }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function incomeCategory()
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id');
    }


}
