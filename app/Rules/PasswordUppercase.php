<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordUppercase implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/[A-Z]/', $value);
    }

    public function message()
    {
        return 'The :attribute must contain at least one uppercase letter.';
    }
}
