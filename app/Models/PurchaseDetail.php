<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id', 'product_id', 'qty', 'unit_price', 'discPer', 'discAmount'
    ];

    public function purchase() {
        return $this->belongsTo(Purchase::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}