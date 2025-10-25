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
        Schema::create('pay_ins', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('transaction_type_id');
            $table->unsignedBigInteger('payment_mode_id');
            $table->unsignedBigInteger('coas_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('income_category_id');
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
        Schema::dropIfExists('pay_ins');
    }
};
