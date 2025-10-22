<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'coas_id',
        'users_id',
        'naration',
        'description',
        'amount',
        'transaction_types_id',
    ];

    // Relation to TransactionType
    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_types_id');
    }
    
    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'invRef_id', 'id')
            ->where('type', 'PayIn');
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}
