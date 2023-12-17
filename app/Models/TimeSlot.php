<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = [
        'form_id', 
        'aptDate', 
        'selected_slot',
        'selected_date',
        'is_available',
    ];

    public function appointments()
    {
        return $this->belongsTo(Appointment::class, 'form_id');
    }
}
