<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/verify-email/{token}', [VerificationController::class, 'verifyEmail'])->name('verify.email');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/approvals', [AuthController::class, 'approvals'])->name('approvals');
Route::get('/approvals', 'App\Http\Controllers\ApprovalsController@index')->name('approvals');
Route::put('/update-user-verification/{userId}', [UserController::class, 'updateVerification'])->name('user.updateVerification');
Route::get('/alumni-list', [UserController::class, 'showVerifiedAlumni'])->name('alumni-list');
Route::get('/dashboard', [UserController::class, 'showAlumniCount'])->name('dashboard');
// Route::get('/alumni-list', [AuthController::class, 'alumniList'])->name('alumni-list');


use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

Route::get('/send-email', function () {
    Mail::to('jabuela22@gmail.com')->send(new TestEmail());
    return 'Email sent successfully';
});



