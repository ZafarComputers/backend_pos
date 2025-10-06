<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invRet_date',
        'pos_inv_no',
        'return_inv_amout',
    ];

    public function details()
    {
        return $this->hasMany(PosReturnDetail::class, 'pos_return_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
