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
        Schema::create('coa_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coa_main_id')->constrained()->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('title');
            $table->enum('type', ['asset', 'liability', 'capital', 'income', 'expense']);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coa_subs');
    }
};