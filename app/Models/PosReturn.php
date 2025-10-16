<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'vendor_id',
        'invRet_date',
        'pos_id',
        'reason',
        'return_inv_amout',
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

    public function details()
    {
        return $this->hasMany(PosReturnDetail::class, 'pos_return_id');
    }
    
    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }


}
