<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
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
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
