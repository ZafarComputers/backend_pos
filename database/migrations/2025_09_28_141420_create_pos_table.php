<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->id();
            $table->date('inv_date');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('description', 255)->nullable();
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('discPer', 5, 2)->default(0);
            $table->decimal('discAmount', 10, 2)->default(0);
            $table->decimal('inv_amount', 10, 2)->default(0);
            $table->decimal('paid', 10, 2)->default(0);
            $table->timestamps();

            // Foreign keys
            $table->foreignId('transaction_type_id')
                  ->constrained('transaction_types')
                  ->cascadeOnDelete();

            $table->foreignId('payment_mode_id')
                  ->constrained('payment_modes')
                  ->cascadeOnDelete();

            // ✅ New foreign key for Employee
            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pos');
    }
};
