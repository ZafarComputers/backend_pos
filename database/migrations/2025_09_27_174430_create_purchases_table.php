<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('pur_date');
            $table->string('pur_inv_barcode')->unique();
            $table->unsignedBigInteger('vendor_id');
            $table->string('ven_inv_no')->nullable();
            $table->date('ven_inv_date')->nullable();
            $table->string('ven_inv_ref')->nullable();
            $table->text('description')->nullable();
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('discount_amt', 12, 2)->default(0);
            $table->decimal('inv_amount', 12, 2)->default(0);
            
            // ✅ New field
            $table->enum('payment_status', ['paid', 'unpaid', 'overdue'])->default('unpaid');

            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('purchases');
    }
};
