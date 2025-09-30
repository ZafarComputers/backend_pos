<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoaMain extends Model
{
    /** @use HasFactory<\Database\Factories\CoaMainFactory> */
    use HasFactory;

    protected $fillable = ['title', 'status'];
    
}
