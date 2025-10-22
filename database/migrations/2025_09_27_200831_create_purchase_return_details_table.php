<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_return_details', function (Blueprint $table) {
            $table->id();

            // Purchase return link
            $table->foreignId('purchase_return_id')
                ->constrained('purchase_returns', 'id', 'fk_prd_return')
                ->cascadeOnDelete();

            // Product link
            $table->foreignId('product_id')
                ->constrained('products', 'id', 'fk_prd_product')
                ->cascadeOnDelete();

            $table->decimal('qty', 10, 2);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('discAmount', 15, 2)->default(0);
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('discPer', 8, 2)->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_return_details');
    }
};
