<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('design_code')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('sub_category_id');
            $table->decimal('sale_price', 10, 2)->default(0);
            $table->integer('opening_stock_quantity')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->string('barcode')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();

            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
