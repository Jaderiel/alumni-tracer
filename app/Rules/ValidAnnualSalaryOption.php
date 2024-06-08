<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAnnualSalaryOption implements Rule
{
    public function passes($attribute, $value)
    {
        $validOptions = [
            'below ₱4000',
            '₱4001 - ₱8000',
            '₱8001 - ₱16000',
            '₱16001 - ₱25000',
            '₱25001 - ₱33000',
            '₱33001 - ₱41000',
            '₱41001 - ₱50000',
            '₱50001 - ₱58000',
            '₱58001 - ₱66000',
            '₱66001 - ₱75000',
            '₱75001 - ₱83000',
            '₱83001 - ₱91000',
            '₱91001 - ₱100000',
            '₱100001 above',
        ];

        return in_array($value, $validOptions);
    }

    public function message()
    {
        return 'The selected :attribute is invalid.';
    }
}
