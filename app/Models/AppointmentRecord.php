<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sickness',
        'seriousness',
        'specification',
        'aptDate',
        'selected_date',
        'selected_slot',
        'is_available',
        'status',
    ];

    // Define the relationship with the Userdetail model
    public function userdetails()
    {
        return $this->belongsTo(UserDetail::class, 'user_id', 'id');
    }
}