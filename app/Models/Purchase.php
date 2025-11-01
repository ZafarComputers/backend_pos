<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'pur_date', 'pur_inv_barcode', 'vendor_id', 'ven_inv_no',
        'ven_inv_date', 'ven_inv_ref', 'description',
        'discount_percent', 'discount_amt', 'inv_amount',
        'payment_status', 'transaction_type_id', 'payment_mode_id'

    ];

    public function details() {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produtc()
    {
        return $this->belongsTo(Product::class, 'product_id');
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'invRef_id');
    }

    protected static function booted()
    {
        static::deleted(function ($purchase) {
            $purchase->transactions()->delete();
        });
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    


}