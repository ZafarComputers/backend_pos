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
        Schema::create('pay_outs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            
            $table->foreignId('transaction_type_id')
                  ->default(9) // Default to 'Expenses' in transaction_types
                  ->constrained('transaction_types')
                  ->cascadeOnDelete();
            $table->foreignId('payment_mode_id')
                  ->constrained('payment_modes')
                  ->cascadeOnDelete();       
            $table->unsignedBigInteger('coas_id');
            $table->foreignId('expense_category_id')
                  ->constrained('coas')
                  ->cascadeOnDelete();
            $table->unsignedBigInteger('users_id');
            $table->text('naration')->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_outs');
    }
};
