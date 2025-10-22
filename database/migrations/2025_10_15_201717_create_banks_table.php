<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_type_id')
                  ->constrained('transaction_types')
                  ->cascadeOnDelete();
            $table->string('acc_holder_name');
            $table->string('acc_no')->unique();
            $table->enum('acc_type', ['Current', 'Saving']);
            $table->decimal('op_balance', 15, 2)->default(0);
            $table->text('note')->nullable();
            $table->enum('status', ['Active', 'Closed'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
