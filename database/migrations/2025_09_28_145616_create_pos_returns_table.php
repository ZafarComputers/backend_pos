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
        Schema::create('pos_returns', function (Blueprint $table) {
            $table->id();

            // Basic relationships
            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('pos_id')
                ->constrained('pos') // adjust if your main POS table name differs
                ->cascadeOnDelete();

            // Transactional info
            $table->date('invRet_date');
            $table->string('reason')->nullable();
            $table->decimal('return_inv_amout', 15, 2)->default(0);

            // Accounting references
            $table->foreignId('transaction_type_id')
                ->nullable() // ✅ allow null to avoid insert errors
                ->default(4) // ✅ default to "Sale Return Transaction" (optional)
                ->constrained('transaction_types')
                ->cascadeOnDelete();

            $table->foreignId('payment_mode_id')
                ->nullable() // ✅ optional
                ->constrained('payment_modes')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_returns');
    }
};
