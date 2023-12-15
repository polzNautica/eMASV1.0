<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserdetailsTable extends Migration
{
    public function up()
    {
        Schema::create('userdetails', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->string('full_name')->nullable();
            $table->date('date_of_birth');
            $table->string('gender')->nullable();
            $table->string('phone_number')->unique();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('userdetails');
    }
}
