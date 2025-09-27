<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /** @use HasFactory<\Database\Factories\VendorFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'cnic',
        'address',
        'city_id',
        'status',
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    
}
