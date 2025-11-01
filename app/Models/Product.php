<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'design_code',
        'image_path',
        'sub_category_id',
        'sale_price',
        'opening_stock_quantity',
        'stock_in_quantity',
        'stock_out_quantity',
        'in_stock_quantity',
        'user_id',
        'vendor_id',
        'barcode',
        'qrcode',
        'status',
    ];

    /* ==========================
       🔹 RELATIONSHIPS
       ========================== */

    public function subCategory()
    {
        // return $this->belongsToThrough(Category::class, SubCategory::class);
        // or
        return $this->belongsTo(Category::class, 'category_id');

        // return $this->belongsTo(SubCategory::class, 'sub_category_id')
        //     ->select('id', 'title', 'category_id');
    }

    public function category()
    {
        // ✅ Corrected relation: use hasOneThrough for indirect category access
        return $this->hasOneThrough(
            Category::class,
            SubCategory::class,
            'id',            // Foreign key on SubCategory table
            'id',            // Foreign key on Category table
            'sub_category_id', // Local key on Product table
            'category_id'    // Local key on SubCategory table
        )->select('categories.id', 'categories.title');
    }

    public function vendor()
    {
        // return $this->belongsTo(Vendor::class, 'vendor_id')
            // ->select('id', 'title', 'status');
        return $this->belongsTo(Vendor::class, 'vendor_id')
            ->select('id', 'first_name', 'last_name', 'status');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class, 'product_id');
    }

    public function posDetails()
    {
        return $this->hasMany(PosDetail::class, 'product_id');
    }

    /* ==========================
       🔹 ACCESSORS & HELPERS
       ========================== */

    public function getStockSummaryAttribute()
    {
        $purchased = $this->purchaseDetails()->sum('qty');
        $sold = $this->posDetails()->sum('qty');

        $opening = $this->opening_stock_quantity ?? 0;
        $inStock = $opening + $purchased - $sold;

        return [
            'opening_stock' => $opening,
            'purchased'     => $purchased,
            'sold'          => $sold,
            'in_stock'      => $inStock,
        ];
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    /* ==========================
       🔹 MANY-TO-MANY RELATIONS
       ========================== */

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }
}
