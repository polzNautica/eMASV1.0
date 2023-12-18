<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Models\AppointmentRecord;

class CleanUpAppointments extends Command
{
    protected $signature = 'appointments:cleanup';
    protected $description = 'Move old appointments and time slots to appointment_records table and delete old records';

    public function handle()
    {

        $today = now()->format('Y-m-d');

        TimeSlot::whereDate('created_at', '<', $today)->chunk(200, function ($timeSlots) {
            foreach ($timeSlots as $timeSlot) {
                AppointmentRecord::create([
                    'user_id' => $timeSlot->appointments->user_id,
                    'sickness' => $timeSlot->appointments->sickness,
                    'seriousness' => $timeSlot->appointments->seriousness,
                    'specification' => $timeSlot->appointments->specification,
                    'aptDate' => $timeSlot->aptDate,
                    'selected_date' => $timeSlot->selected_date,
                    'selected_slot' => $timeSlot->selected_slot,
                    'is_available' => $timeSlot->is_available,
                ]);
            }
        });

        // Delete old appointments and time slots
        Appointment::whereDate('created_at', '<', $today)->delete();
        TimeSlot::whereDate('created_at', '<', $today)->delete();

        $this->info('Cleaned up old appointments and time slots.');
    }
}

