<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_type_id')->default(9);
            $table->string('name');
            $table->unsignedBigInteger('expense_category_id');
            $table->text('description')->nullable();
            $table->date('date');
            $table->decimal('amount', 12, 2);
            $table->timestamps();

            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('expense_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
