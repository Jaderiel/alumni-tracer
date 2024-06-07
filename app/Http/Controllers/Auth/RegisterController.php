<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Rules\NotSuperAdmin;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'first_name' => ['required', new NotSuperAdmin],
            'last_name' => ['required', new NotSuperAdmin],
            'middle_name' => ['nullable', new NotSuperAdmin],
            'course' => 'required|in:Bachelor of Arts in Broadcasting,Bachelor of Science in Accountancy,Bachelor of Science in Accounting Technology,Bachelor of Science in Accounting Information Systems,Bachelor of Science in Social Work,Bachelor of Science in Information Systems,Associate in Computer Technology,Computer Technology,Computer Programming,Health Care Services,International Cookery,Mass Communication,Nursing Student,Office Management',
            'batch' => 'required|in:' . $this->generateBatchOptions(),
            'username' => ['required', 'unique:users', new NotSuperAdmin],
            'email' => 'required|email|unique:users',
            'password' => ['required', 'min:6', 'confirmed', new NotSuperAdmin],
        ]);

        $user = User::create([
            'user_type' => 'Alumni',
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'course' => $request->course,
            'batch' => $request->batch,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['success' => 'Registration successful!']);

    }

    private function generateBatchOptions()
    {
        $options = [];
        for ($year = date('Y'); $year >= 2006; $year--) {
            $nextYear = $year + 1;
            $options[] = "$year - $nextYear";
        }
        return implode(',', $options);
    }
}
