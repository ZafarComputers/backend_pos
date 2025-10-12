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
            $table->date('inv_date');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('discPer', 5, 2)->default(0);
            $table->decimal('discAmount', 10, 2)->default(0);
            $table->decimal('inv_amount', 10, 2)->default(0);
            $table->decimal('paid', 10, 2)->default(0);
            $table->enum('payment_mode', ['Cash', 'Credit', 'Bank'])->default('Cash');
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