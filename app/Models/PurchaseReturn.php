<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_date',
        'return_inv_no',
        'vendor_id',
        'reason',
        'discount_percent',
        'discount_amt',
        'return_amount',
        'payment_status',
    ];

    public function details()
    {
        return $this->hasMany(PurchaseReturnDetail::class);
    }

    // Add this relationship
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    // If you also want purchase relation
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    
}
