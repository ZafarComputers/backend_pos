<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_type_id')->default(8);
            $table->date('date');
            $table->unsignedBigInteger('income_category_id');
            $table->string('incm_cat_name');
            $table->text('notes')->nullable();
            $table->decimal('amount', 12, 2);
            $table->timestamps();

            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('income_category_id')->references('id')->on('income_categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
