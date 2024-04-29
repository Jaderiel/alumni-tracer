<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnalyticsController;

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
Route::delete('/approvals/{userId}', [UserController::class, 'delete'])->name('user.delete');
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
Route::post('/update-post', [App\Http\Controllers\PostController::class, 'updatePost'])->name('update.post');
Route::delete('/delete-post/{id}', [PostController::class, 'delete'])->name('delete.post');


Route::get('/events', [EventsController::class, 'events'])->name('events');
Route::get('/events/{user_id}/{event_id}', [EventsController::class, 'register'])->name('register-to-event');
Route::get('/get-registered-users/{eventId}', [EventsController::class, 'getRegisteredUsers'])->name('get.registered.users');



Route::get('/jobs', [JobsController::class, 'jobs'])->name('jobs'); //pagshoshow ng jobs
Route::get('/jobs/job-post', [JobsController::class, 'jobPost'])->name('job-post'); //pagcecreate ng jobs
Route::post('/jobs/job-post', [JobsController::class, 'store'])->name('job.store'); //pagsstore ng jobs
Route::get('/jobs/{job}', [JobsController::class, 'show'])->name('jobs.show');
Route::put('/jobs/{job}', [JobsController::class, 'update'])->name('jobs.update');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/add-gallery', [GalleryController::class, 'create'])->name('gallery.add');
Route::post('/gallery/add-gallery', [GalleryController::class, 'store'])->name('gallery.store');

Route::get('/user-profile', [ProfileController::class, 'index'])->name('user-profile');
Route::get('/show-profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');