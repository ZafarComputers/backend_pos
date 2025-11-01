<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'pos_id',
        'invRet_date',
        'reason',
        'return_inv_amount',
        'tax',
        'discPer',
        'discAmount',
        'paid', 
        'transaction_type_id', // ✅ new column
        'payment_mode_id', // ✅ new column
    ];

    // ✅ Relations

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class, 'pos_id');
    }

    // public function details()
    // {
    //     return $this->hasMany(PosReturnDetail::class, 'pos_return_id');
    // }
    public function details()
    {
        return $this->hasMany(PosReturnDetail::class, 'pos_return_id', 'id');
    }

    
    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }

     public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
        
    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }
    
    public function isActive()
    {
        return $this->status === 'Active';
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }  
    

    


}