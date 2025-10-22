<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();

            $table->foreignId('purchase_id')
                ->nullable()
                ->constrained('purchases')
                ->nullOnDelete();

            // Additional references
            $table->foreignId('transaction_type_id')
                ->nullable()
                ->constrained('transaction_types')
                ->nullOnDelete();

            $table->foreignId('payment_mode_id')
                ->nullable()
                ->constrained('payment_modes')
                ->nullOnDelete();

            $table->string('return_inv_no')->unique();
            $table->date('return_date');
            $table->string('reason')->nullable();
            $table->decimal('discount_percent', 8, 2)->default(0);
            $table->decimal('discount_amt', 15, 2)->default(0);
            $table->decimal('return_amount', 15, 2)->default(0);

            // Fix for your error
            $table->enum('payment_status', ['paid', 'partial', 'overdue'])->default('paid');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_returns');
    }
};
