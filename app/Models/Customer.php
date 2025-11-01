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

        // Gurunter Person's Info
        'cnic2', 
        'name2',
        'cell_no3'
    ];

    // Relationship: multiple COAs (all linked to this customer)
    public function coas()
    {
        return $this->hasMany(Coa::class, 'customer_id');
    }

    // Each customer has one COA
    public function coa()
    {
        return $this->hasOne(Coa::class, 'customer_id', 'id');
    }

    // Optional: main/default COA (if you want a single reference)
    public function mainCoa()
    {
        return $this->hasOne(Coa::class, 'customer_id')->orderBy('id'); // first COA
    }

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

    public function isActive()
    {
        return $this->status === 'Active';  
    }

}