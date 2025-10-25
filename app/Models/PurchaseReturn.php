<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_inv_no',
        'purchase_id',
        'reason',
        'return_date',
        'vendor_id',
        // 'users_id',
        // 'coas_id',
        'payment_mode_id',
        'transaction_type_id',
        // 'description',
        'return_amount',

    ];

    // Relationships
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function details()
    {
        return $this->hasMany(PurchaseReturnDetail::class);
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coas_id');
    }   

    public function transactions()
    {
         return $this->hasMany(Transaction::class, 'invRef_id');    
    }

}