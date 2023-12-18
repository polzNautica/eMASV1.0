<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('userdetails');
            $table->string('sickness')->nullable();
            $table->string('seriousness')->nullable();
            $table->text('specification')->nullable();
            $table->date('aptDate')->nullable();
            $table->string('selected_date')->nullable();
            $table->string('selected_slot')->nullable();
            $table->boolean('is_available')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointment_records');
    }
}