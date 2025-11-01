<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            // Pakistani CNIC format: 37405-1234567-1 (15 characters including dashes)
            $table->string('cnic', 15)->nullable();

            $table->string('name', 150);
            $table->string('email', 150)->nullable();
            $table->string('address', 255)->nullable();
            // FK relation to cities table
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            // Pakistani mobile numbers: 11 digits (03#########)
            $table->string('cell_no1', 20);
            $table->string('cell_no2', 20)->nullable();
            $table->string('image_path', 255)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            
            // Gurunter Person's Info
            $table->string('cnic2', 15)->nullable();
            $table->string('name2', 150)->nullable();
            $table->string('cell_no3', 20)->nullable();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};