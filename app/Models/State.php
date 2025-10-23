<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'country_id',
        'status',
    ];

    /**
     * Always eager-load the country relationship.
     *
     * @var array<int, string>
     */
    protected $with = ['country'];

    /**
     * Scope a query to only include active states.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Get the country that this state belongs to.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * A state has many cities.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}