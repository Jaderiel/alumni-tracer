<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidDegrees implements Rule
{
    protected $acceptableDegrees = [
        'Doctoral', 
        "Master's", 
        "Bachelor's", 
        'Associate', 
        'Diploma', 
        'Certificate'
    ];

    public function passes($attribute, $value)
    {
        return in_array($value, $this->acceptableDegrees);
    }

    public function message()
    {
        return 'The selected :attribute is invalid.';
    }
}
