<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type_id',
        'acc_holder_name',
        'acc_no',
        'acc_type',
        'op_balance',
        'note',
        'status',
    ];

    // Relationship
    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}
