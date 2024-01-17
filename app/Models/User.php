<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function sendPasswordResetNotification($token)
    {
    $this->notify(new ResetPassword($token));
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }


//     protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($user) {
//         // Check if the userdetails relationship exists
//         if ($user->userdetails) {
//             $user->userdetails->user_id = $user->id;
//             $user->userdetails->save();
//         }
//     });
    

//     static::updating(function ($user) {
//         if ($user->userdetails) {
//             // Check if the user has associated userdetails
//             $user->userdetails->update(['user_id' => $user->id]);
//         }
//     });
    
// }

public function userDetails()
{
    return $this->hasOne(UserDetail::class, 'user_id');
}


}
