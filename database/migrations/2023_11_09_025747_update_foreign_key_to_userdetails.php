<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyToUserdetails extends Migration
{
    public function up()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            // Add foreign key constraint to user_id column
            $table->foreign('user_id')->references('id')->on('users');

            // Change date_of_birth column to a date and make it nullable
            $table->date('date_of_birth')->nullable()->change();
            $table->date('phone_number')->nullable()->change();

        });
    }

    public function down()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            // To reverse the changes, you can drop the foreign key and change the date_of_birth back to its original state.
            $table->dropForeign(['user_id']);
            $table->date('date_of_birth')->nullable(false)->change();
            $table->date('phone_number')->nullable(false)->change();

        });
    }
}