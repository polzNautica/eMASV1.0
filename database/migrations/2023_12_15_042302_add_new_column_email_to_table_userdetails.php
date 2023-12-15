<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            // Add the new column
            $table->string('email')->nullable(); // Change the data type and name as needed
        });
    }

    public function down()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            // Drop the new column if needed
            $table->dropColumn('email');
        });
    }
};
