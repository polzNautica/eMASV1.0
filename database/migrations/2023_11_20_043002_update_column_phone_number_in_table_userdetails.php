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
            // Change the column type to varchar
            $table->string('phone_number')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            // Change the column type back to unsigned big integer
            $table->unsignedBigInteger('phone_number')->nullable(false)->change();
        });
    }
};
