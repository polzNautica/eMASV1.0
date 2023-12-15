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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_detail_id'); // Use unsignedBigInteger for foreign keys
            $table->foreign('user_detail_id')->references('id')->on('userdetails'); // Use the correct table name
            $table->string('name')->nullable();
            $table->string('phone_number')->unique();
            $table->unsignedBigInteger('ic')->unique()->nullable(); // Change the data type and name as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
