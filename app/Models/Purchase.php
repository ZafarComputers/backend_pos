<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'pur_date', 
        'pur_inv_barcode', 
        'vendor_id', 
        'ven_inv_no',
        'ven_inv_date', 
        'ven_inv_ref', 
        'description',
        'discount_percent', 
        'discount_amt', 
        'inv_amount', 
        'paid_amount', 
        'payment_status',
        'transaction_type_id', // ✅ new column
        'payment_mode_id', // ✅ new column

    ];

    public function details() {
        return $this->hasMany(PurchaseDetail::class);
    }

    // app/Models/Purchase.php
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }

    public function transactionType() {
        return $this->belongsTo(TransactionType::class);
    }
}
