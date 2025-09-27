<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'ven_inv_no',
        'ven_inv_date',
        'ven_inv_ref',
        'description',
        'product_id',
        'discount_percent',
        'discount_amt',
        'inv_amount',
    ];

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
