<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'field', 'old_value', 'new_value', 'approved'];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

