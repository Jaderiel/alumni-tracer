<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_type',
        'first_name',
        'middle_name',
        'last_name',
        'course',
        'batch',
        'email',
        'username',
        'password',
        'profile_pic',
        'is_email_verified',
        'email_verification_code',
        'email_verified_at',
        'inactive'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verification_code'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employment()
    {
        return $this->hasOne(UserEmployment::class);
    }

    public function posts()
    {
        return $this->hasMany(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function degrees()
    {
        return $this->hasMany(DegreeStatus::class);
    }
}
