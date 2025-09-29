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
        Schema::create('pos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->date('inv_date');
            $table->decimal('inv_amout', 12, 2);
            $table->decimal('tax', 8, 2)->default(0);
            $table->decimal('discPer', 5, 2)->default(0);   // discount percent
            $table->decimal('discount', 12, 2)->default(0); // discount amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos');
    }
};
