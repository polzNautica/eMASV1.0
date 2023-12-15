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
            $table->unsignedBigInteger('phone_number')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            $table->unsignedBigInteger('phone_number')->nullable(false)->change();
        });
    }
};
