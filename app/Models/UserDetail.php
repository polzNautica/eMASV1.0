<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'userdetails';

    protected $fillable = [
        'profile_picture',
        'full_name',
        'date_of_birth',
        'gender',
        'phone_number',
        'nationality',
        'religion',
        'address1',
        'address2',
        'address3',
        'user_id',
        'ic',
        'email',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }
    
}
