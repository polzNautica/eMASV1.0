<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePhoneNumberToUserDetails extends Migration
{
    public function up()
    {
        Schema::table('userdetails', function (Blueprint $table) {

            $table->date('phone_number')->nullable()->change();

        });
    }

    public function down()
    {
        Schema::table('userdetails', function (Blueprint $table) {
            $table->date('phone_number')->nullable(false)->change();

        });
    }
}