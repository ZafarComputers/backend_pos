<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_id',
        'product_id',
        'qty',
        'sale_price',
    ];

    // public function pos()
    // {
    //     return $this->belongsTo(Pos::class, 'pos_id', 'id');
    // }

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
        // return $this->belongsTo(Product::class, 'product_id');
    }

    
}