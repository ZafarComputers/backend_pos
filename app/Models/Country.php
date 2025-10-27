<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'phone_code', 
        'emoji_u', 
        'native',
        'currency',
        'status',
    ];

    /**
     * Scope a query to only include active countries.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * A country has many states.
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    public function cities(): HasMany
    {
        return $this->hasManyThrough(City::class, State::class);
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}