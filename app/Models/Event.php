<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'event_title',
        'event_details',
        'media_url',
        'event_date', 
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];
}
