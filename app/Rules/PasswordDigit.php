<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordDigit implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/\d/', $value);
    }

    public function message()
    {
        return 'The :attribute must contain at least one digit.';
    }
}
