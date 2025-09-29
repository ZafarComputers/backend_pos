<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    /** @use HasFactory<\Database\Factories\PosFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'inv_date',
        'inv_amout',
        'tax',
        'discPer',
        'discount',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
}
