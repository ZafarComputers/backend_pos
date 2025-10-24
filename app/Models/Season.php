<?php

// app/Models/Season.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
    ];

    public function isActive()
    {
        return $this->status === 'Active';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }


    
}