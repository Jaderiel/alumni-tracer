<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCourses implements Rule
{
    public function passes($attribute, $value)
    {
        $validOptions = [
            'Bachelor of Arts in Broadcasting',
            'Bachelor of Science in Accountancy',
            'Bachelor of Science in Accounting Technology',
            'Bachelor of Science in Accounting Information Systems',
            'Bachelor of Science in Social Work',
            'Bachelor of Science in Information Systems',
            'Associate in Computer Technology',
            'Computer Technology',
            'Computer Programming',
            'Health Care Services',
            'International Cookery',
            'Mass Communication',
            'Nursing Student',
            'Office Management',
        ];

        return in_array($value, $validOptions);
    }

    public function message()
    {
        return 'The selected :attribute is invalid.';
    }
}
