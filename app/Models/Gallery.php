<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'course',
        'img_title',
        'img_description',
        'media_url', 
    ];
}
