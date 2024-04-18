<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    protected $fillable = [
        'job_title',
        'job_location',
        'job_type',
        'job_description',
        'company',
        'salary',
        'link',
    ];
}
