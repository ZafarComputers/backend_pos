<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->date('return_date');
            $table->string('return_inv_no');
            $table->unsignedBigInteger('vendor_id');
            $table->string('reason')->nullable();
            $table->decimal('discount_percent', 8, 2)->default(0);
            $table->decimal('discount_amt', 12, 2)->default(0);
            $table->decimal('return_amount', 12, 2)->default(0);
            $table->enum('payment_status', ['paid', 'unpaid', 'overdue'])->default('unpaid'); // ✅ same field
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_returns');
    }
};
