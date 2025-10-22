<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'purchase_id',
        'return_inv_no',
        'return_date',
        'reason',
        'discount_percent',
        'return_amount',
        'payment_mode_id'
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

    
}
