<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id', 
        'sickness', 
        'seriousness'];

    // Define the relationship with UserDetail
    public function userDetails()
    {
        return $this->belongsTo(UserDetail::class, 'user_id');
    }

    public function time_slots()
    {
        return $this->hasMany(TimeSlot::class, 'form_id');
    }
}
