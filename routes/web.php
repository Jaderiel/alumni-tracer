<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/verify-email/{token}', [VerificationController::class, 'verifyEmail'])->name('verify.email');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
// Route for verifying email
Route::get('/verify-email/{token}', 'VerificationController@verify')->name('verify.email');



use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

Route::get('/send-email', function () {
    Mail::to('jabuela22@gmail.com')->send(new TestEmail());
    return 'Email sent successfully';
});


