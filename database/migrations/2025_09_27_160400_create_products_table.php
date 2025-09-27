<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('design_code')->nullable();
            $table->string('image_path')->nullable();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->decimal('sale_price', 10, 2);
            $table->integer('opening_stock_quantity')->default(0);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('barcode')->unique()->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
