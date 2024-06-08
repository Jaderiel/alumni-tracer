<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidBatches implements Rule
{
    public function passes($attribute, $value)
    {
        $validOptions = [];

        // Generate valid batch options
        for ($year = date('Y'); $year >= 2006; $year--) {
            $nextYear = $year + 1;
            $validOptions[] = "$year - $nextYear";
        }

        return in_array($value, $validOptions);
    }

    public function message()
    {
        return 'The selected :attribute is invalid.';
    }
}

