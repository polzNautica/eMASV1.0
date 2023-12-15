<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToUserdetails extends Migration
{
    public function up()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            // Add the new column
            $table->unsignedBigInteger('user_id')->unique()->after('id'); // Change the data type and name as needed
        });
    }

    public function down()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            // Drop the new column if needed
            $table->dropColumn('user_id');
        });
    }
}
