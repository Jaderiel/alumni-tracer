<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidIndustryOption implements Rule
{
    public function passes($attribute, $value)
    {
        $validOptions = [
            'IT Industry',
            'Medicine',
            'Finance',
            'Education',
            'Construction',
            'Manufacturing',
            'Retail',
            'Hospitality',
            'Transportation',
            'Agriculture',
            'Real Estate',
            'Entertainment',
        ];

        return in_array($value, $validOptions);
    }

    public function message()
    {
        return 'The selected :attribute is invalid.';
    }
}

