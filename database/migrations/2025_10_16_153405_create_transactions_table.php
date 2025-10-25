<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->unsignedBigInteger('invRef_id')->nullable();
        $table->unsignedBigInteger('transaction_type_id');
        $table->unsignedBigInteger('coas_id');
        $table->unsignedBigInteger('coaRef_id')->nullable();
        $table->unsignedBigInteger('users_id');
        $table->text('description')->nullable();
        $table->decimal('debit', 15, 2)->default(0);
        $table->decimal('credit', 15, 2)->default(0);
        $table->timestamps();

        // ✅ Correct indexes
        $table->index(['transaction_type_id', 'coas_id', 'users_id']);

        // ✅ Foreign keys
        $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');
        $table->foreign('coas_id')->references('id')->on('coas')->onDelete('cascade');
        $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
    });
   
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
