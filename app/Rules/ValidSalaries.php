<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidSalaries implements Rule
{
    public function passes($attribute, $value)
    {
        $validOptions = [
            '₱5,000 - ₱10,000',
            '₱20,000 - ₱30,000',
            '₱30,001 - ₱40,000',
            '₱40,001 - ₱50,000',
            '₱50,001 - ₱60,000',
            '₱60,001 - ₱70,000',
            '₱70,001 - ₱80,000',
            '₱80,001 - ₱90,000',
            '₱90,001 - ₱100,000',
            '₱100,001 - ₱110,000',
            '₱110,001 - ₱120,000'
        ];

        return in_array($value, $validOptions);
    }

    public function message()
    {
        return 'The selected :attribute is invalid.';
    }
}
