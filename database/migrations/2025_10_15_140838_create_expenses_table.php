<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('transaction_type_id')
                  ->default(9) // Default to 'Expenses' in transaction_types
                  ->constrained('transaction_types')
                  ->cascadeOnDelete();

            $table->foreignId('expense_category_id')
                  ->constrained('expense_categories')
                  ->cascadeOnDelete();

            $table->foreignId('payment_mode_id')
                  ->constrained('payment_modes')
                  ->cascadeOnDelete();

            // Expense details
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date');
            $table->decimal('amount', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
