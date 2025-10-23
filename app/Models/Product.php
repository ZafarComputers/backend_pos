<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\PurchaseDetail;
use App\Models\PosDetail;
use App\Models\User;
use App\Models\Vendor;

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
        'in_stock_quantity',   // ✅ Add this if you’re maintaining stock directly
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
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function category()
    {
        // ✅ Corrected hasOneThrough mapping
        return $this->hasOneThrough(
            Category::class,        // Final related model
            SubCategory::class,     // Intermediate model
            'id',                   // Foreign key on SubCategory table
            'id',                   // Foreign key on Category table
            'sub_category_id',      // Local key on Product table
            'category_id'           // Local key on SubCategory table
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
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
       🔹 STOCK CALCULATIONS (Optional Helper)
       ========================== */

    /**
     * Compute stock information dynamically
     * (used only for reporting/debugging, not actual updates)
     */
    public function getStockSummaryAttribute()
    {
        $purchased = $this->purchaseDetails()->sum('qty');
        $sold      = $this->posDetails()->sum('qty');

        $openingStock = $this->opening_stock_quantity ?? 0;
        $inStock = $openingStock + $purchased - $sold;

        return [
            'opening_stock' => $openingStock,
            'purchased'     => $purchased,
            'sold'          => $sold,
            'in_stock'      => $inStock,
        ];
    }

    public function isActive()
    {
        return $this->status === 'Active';
    }

    
}