<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PosBankDetail;

class Pos extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'inv_date', 
        'customer_id', 
        'transaction_type_id', // ✅ new column
        'payment_mode_id', // ✅ new column
        'employee_id', // ✅ added column
        'description', // ✅ include this
        'tax', 
        'discPer', 
        'discAmount',
        'inv_amount', 
        'paid',
        'total_extra_amount'
    ];

    public function details()
    {
        return $this->hasMany(PosDetail::class, 'pos_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function bankDetail()
    {
        return $this->hasOne(PosBankDetail::class, 'pos_id', 'id');
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'invRef_id');
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