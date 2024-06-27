<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidCourses;
use App\Rules\ValidBatches;
use App\Rules\PasswordLowercase;
use App\Rules\PasswordUppercase;
use App\Rules\PasswordDigit;
use App\Rules\PasswordSpecialCharacter;

class PasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust this as needed
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'course' => ['required', new ValidCourses],
            'batch' => ['required', new ValidBatches],
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:10',
                new PasswordLowercase,
                new PasswordUppercase,
                new PasswordDigit,
                new PasswordSpecialCharacter,
                'confirmed',
            ],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'course.required' => 'Course is required.',
            'batch.required' => 'Batch is required.',
            'username.required' => 'Username is required.',
            'username.unique' => 'Username has already been taken.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email has already been taken.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 10 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
