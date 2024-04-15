<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'profile_pic'
    ];

    protected $hidden = [
        'password',
        'remember_token',
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


}
