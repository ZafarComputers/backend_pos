<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'coa_sub_id',
        'status',
    ];

    /**
     * Each COA belongs to one sub COA.
     */
    public function coaSub()
    {
        return $this->belongsTo(CoaSub::class, 'coa_sub_id');
    }

    /**
     * Each COA indirectly belongs to a main COA (through CoaSub).
     */
    public function coaMain()
    {
        return $this->hasOneThrough(
            CoaMain::class,
            CoaSub::class,
            'id',          // Foreign key on CoaSub table
            'id',          // Foreign key on CoaMain table
            'coa_sub_id',  // Local key on Coa table
            'coa_main_id'  // Local key on CoaSub table
        );
    }
    
    // Scope for Active records
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

}    
