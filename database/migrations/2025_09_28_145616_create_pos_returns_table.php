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
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->date('invRet_date');

            // Replace string 'pos_inv_no' with a foreign key 'pos_id'
            $table->foreignId('pos_id')
                ->constrained('pos') // or 'pos_invoices' — use your actual table name here
                ->cascadeOnDelete();
            $table->string('reason')->nullable();
            $table->decimal('return_inv_amout', 12, 2);
            $table->timestamps();
        

            // Foreign keys
            $table->foreignId('transaction_type_id')
                  ->constrained('transaction_types')
                  ->cascadeOnDelete();

            $table->foreignId('payment_mode_id')
                  ->constrained('payment_modes')
                  ->cascadeOnDelete();
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
