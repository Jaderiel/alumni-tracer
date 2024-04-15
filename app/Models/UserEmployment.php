<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmployment extends Model
{
    protected $table = 'user_employment';

    protected $fillable = [
        'date_of_first_employment',
        'is_employed',
        'date_of_employment',
        'industry', 
        'job_title', 
        'company_name', 
        'company_address', 
        'annual_salary'
        // Add other fillable attributes as needed
    ];
    // Your model definition goes here
}
