<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PosBankDetail;

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
        'payment_mode', // ✅ new column
    ];


    public function details()
    {
        return $this->hasMany(PosDetail::class, 'pos_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function bankDetail()
    {
        return $this->hasOne(PosBankDetail::class, 'pos_id', 'id');
    }


}