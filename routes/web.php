<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventsController;
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
// Route::get('/alumni-list', [AuthController::class, 'alumniList'])->name('alumni-list');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/dashboard', [PostController::class, 'store'])->name('dashboard.store');
Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
Route::put('/dashboard/{id}', [PostController::class, 'update'])->name('dashboard.update');
Route::put('/update-post/{id}',  [PostController::class, 'update'])->name('update-post');

Route::get('/events', [EventsController::class, 'events'])->name('events');


use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

Route::get('/send-email', function () {
    Mail::to('jabuela22@gmail.com')->send(new TestEmail());
    return 'Email sent successfully';
});