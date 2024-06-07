<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotSuperAdmin implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value contains "Admin" or "Super Admin"
        return !str_contains($value, 'Admin') && !str_contains($value, 'Super Admin');
    }

    public function message()
    {
        return 'The :attribute field cannot contain such word.';
    }
}


