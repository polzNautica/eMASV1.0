<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'ic',
        'user_id',
    ];
    // Define the relationship with UserDetail
    public function userDetail()
    {
        return $this->belongsTo(UserDetail::class);
    }
}
