<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $maxAttempts = 3; // Maximum number of login attempts allowed
        $decayMinutes = 5; // Number of minutes to wait before re-enabling login

        // Check if login attempts exceeded the limit
        if (Session::has('loginAttempts') && Session::get('loginAttempts') >= $maxAttempts) {
            // Check if enough time has passed to re-enable login
            $disabledUntil = Session::get('loginDisabledUntil');
            if ($disabledUntil && Carbon::now()->lt(Carbon::parse($disabledUntil))) {
                $disabledMinutes = Carbon::now()->diffInMinutes(Carbon::parse($disabledUntil));
                return redirect()->back()->withErrors(['message' => "Login has been disabled. Please try again after $disabledMinutes minutes."])->withInput($request->except('password'));
            }
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Please enter your username.',
            'password.required' => 'Please enter your password.',
        ]);

        if ($validator->fails()) {
            return $this->handleFailedLogin($request);
        }

        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            $this->incrementLoginAttempts();

            return $this->handleFailedLogin($request);
        }

        // Reset login attempts on successful login
        Session::forget('loginAttempts');

        $user = Auth::user();

        if ($user->inactive) {
            Auth::logout();
            return redirect()->back()->withErrors(['message' => 'Your account is inactive. Please contact the admin for further assistance.'])->withInput($request->except('password'));
        }

        if (is_null($user->email_verified_at)) {
            Auth::logout();
            return redirect()->route('ver.show')->withErrors(['message' => 'Your email is not verified. Please check your email to verify your account.']);
        }

        if (!$user->is_email_verified) {
            Auth::logout();
            return redirect()->back()->withErrors(['message' => 'Your email is not verified. Please wait for the admin to verify your email'])->withInput($request->except('password'));
        }

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function handleFailedLogin(Request $request)
    {
        $this->incrementLoginAttempts();

        return redirect()->back()->withErrors(['message' => 'Invalid username or password.'])->withInput($request->except('password'));
    }

    private function incrementLoginAttempts()
    {
        $attempts = Session::get('loginAttempts', 0) + 1;
        Session::put('loginAttempts', $attempts);

        if ($attempts >= 3) {
            // Disable login for decayMinutes minutes
            $disabledUntil = Carbon::now()->addMinutes(5)->toDateTimeString();
            Session::put('loginDisabledUntil', $disabledUntil);
        }
    }
}
