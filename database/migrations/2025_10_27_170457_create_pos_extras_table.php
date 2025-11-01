<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pos_extras', function (Blueprint $table) {
            $table->id();
             $table->foreignId('pos_detail_id')
                  ->constrained('pos_details')
                  ->onDelete('cascade');
            $table->string('title');           // e.g. "Lace", "Size", "Embroidery"
            $table->string('value')->nullable(); // e.g. "Golden", "Medium"
            $table->decimal('amount', 10, 2)->default(0); // Extra charge amount
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pos_extras');
    }
};
