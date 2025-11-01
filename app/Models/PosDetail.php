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
        'discPer', 
        'discAmount',
        'sale_price',
    ];


    public function extras()
    {
        return $this->hasMany(PosExtra::class);
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
        // return $this->belongsTo(Product::class, 'product_id');
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    

    
}