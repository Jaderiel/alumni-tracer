<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forum'; 

    protected $fillable = ['user_id', 'caption', 'media_url']; 
}
