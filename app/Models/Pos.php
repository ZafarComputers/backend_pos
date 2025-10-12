<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    protected $fillable = [
        'inv_date', 
        'customer_id', 
        'tax', 
        'discPer', 
        'discAmount',
        'inv_amount', 
        'paid',
    ];


    // public function posDetails()
    // {
    //     // return $this->hasMany(PosDetail::class);
    //     return $this->hasMany(PosDetail::class, 'pos_id');
    // }

    public function details()
    {
        return $this->hasMany(PosDetail::class, 'pos_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }


}