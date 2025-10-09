<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /** @use HasFactory<\Database\Factories\SubCategoryFactory> */
    use HasFactory;

     protected $fillable = [
        'title',
        'img_path',
        'category_id',
        'status',
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    
}
