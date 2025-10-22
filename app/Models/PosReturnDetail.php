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
        return $this->belongsTo(PosReturn::class, 'pos_return_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
    

}
