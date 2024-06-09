<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeStatus extends Model
{
    use HasFactory;

    protected $table = 'degree_status';

    protected $fillable = [
        'user_id',
        'degree',
        'school',
        'is_ongoing',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
