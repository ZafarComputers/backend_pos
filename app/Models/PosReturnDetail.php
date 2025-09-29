<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosReturnDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_return_id',
        'product_id',
        'qty',
        'return_unit_price',
    ];

    public function posReturn()
    {
        return $this->belongsTo(PosReturn::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
