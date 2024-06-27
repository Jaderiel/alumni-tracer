<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordLowercase implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/[a-z]/', $value);
    }

    public function message()
    {
        return 'The :attribute must contain at least one lowercase letter.';
    }
}
