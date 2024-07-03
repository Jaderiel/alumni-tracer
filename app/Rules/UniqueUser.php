<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class UniqueUser implements Rule
{
    public function passes($attribute, $value)
    {
        // Assuming $value is the `first_name` being validated
        // Access other input values using request()->input('field_name')
        $firstName = request()->input('first_name');
        $lastName = request()->input('last_name');
        $course = request()->input('course');
        $batch = request()->input('batch');

        // Check if user already exists
        return !User::where('first_name', $firstName)
                    ->where('last_name', $lastName)
                    ->where('course', $course)
                    ->where('batch', $batch)
                    ->exists();
    }

    public function message()
    {
        return 'A user with the same first name, last name, batch and course already exists.';
    }
}
