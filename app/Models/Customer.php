<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Customer Model
 *
 * Represents customers in the system.
 */
class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnic',
        'name',
        'email',
        'address',
        'city_id',
        'cell_no1',
        'cell_no2',
        'image_path',
        'status',
    ];

    /**
     * Relation: Customer belongs to a City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function invoices()
    {
        return $this->hasMany(Pos::class, 'customer_id', 'id');
    }



    }
