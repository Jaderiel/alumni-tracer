<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_title', 'media_url', 'event_details', 'event_date', 'event_time', 'inactive'];
}
