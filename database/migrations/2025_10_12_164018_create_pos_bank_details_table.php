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
        Schema::create('pos_bank_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pos_id')
                ->constrained('pos')
                ->onDelete('cascade');
            $table->string('bank_name');
            $table->string('account_title')->nullable();
            $table->string('account_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_bank_details');
    }
};
