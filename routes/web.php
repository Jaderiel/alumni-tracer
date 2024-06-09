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
use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\EmploymentHistoryController;
use App\Http\Controllers\DegreeStatusController;

// Route::get('/download-pdf', 'PDFController@downloadPDF')->name('download.pdf')->middleware('auth');
Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login.show');
    Route::get('/mobile-login', [AuthController::class, 'mobileLogin'])->name('mobileLogin.show');
    Route::get('/mobile-signup', [AuthController::class, 'mobileSignUp'])->name('mobileSignUp.show');
    // Route::post('/register', 'Auth\RegisterController@register')->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/verify-email/{token}', [VerificationController::class, 'verifyEmail'])->name('verify.email');
    Route::post('/', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
});

Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/home', [WebsiteController::class, 'index'])->name('website.show');
Route::get('/about', [WebsiteController::class, 'about'])->name('about.show');
Route::get('/services', [WebsiteController::class, 'services'])->name('services.show');
Route::get('/privacy-notice', [WebsiteController::class, 'privacyNotice'])->name('privacy-notice.show');
Route::get('/main', [WebsiteController::class, 'main'])->name('main');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::group(['middleware' => ['auth.user']], function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/approvals', [AuthController::class, 'approvals'])->name('approvals');
    Route::get('/priv-notice', [AuthController::class, 'privNotice'])->name('privNotice');
    Route::get('/approvals', 'App\Http\Controllers\ApprovalsController@index')->name('approvals');
    Route::put('/update-user-verification/{userId}', [UserController::class, 'updateVerification'])->name('user.updateVerification');
    Route::get('/alumni-list', [UserController::class, 'showVerifiedAlumni'])->name('alumni-list');
    Route::delete('/approvals/{userId}', [UserController::class, 'delete'])->name('user.delete');
    Route::delete('/degrees/{id}', [UserController::class, 'destroyDegree']);
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
    Route::put('/update-post/{id}', [App\Http\Controllers\PostController::class, 'updatePost'])->name('update.post');
    Route::get('/add-post', [PostController::class, 'addPost'])->name('add.post');
    Route::get('/update-post/{id}', [PostController::class, 'showUpdatePost'])->name('showUpdate.post');
    Route::delete('/update-post/{id}', [PostController::class, 'delete'])->name('delete.post');
    Route::get('/liked-users/{postId}', [AuthController::class, 'getLikedUsers'])->name('getLikedUsers');

    Route::get('/events', [EventsController::class, 'events'])->name('events');
    Route::get('/events/{user_id}/{event_id}', [EventsController::class, 'register'])->name('register-to-event');
    Route::get('/get-registered-users/{eventId}', [EventsController::class, 'getRegisteredUsers'])->name('get.registered.users');
    Route::get('/add-event', [EventsController::class, 'addEvent'])->name('add-event');
    Route::post('/add-event', [EventsController::class, 'store'])->name('events.store');
    Route::get('/add-announcement', [EventsController::class, 'addAnn'])->name('add-ann');
    Route::post('/add-announcement', [EventsController::class, 'storeAnn'])->name('ann.store');
    Route::delete('/events/{id}', [EventsController::class, 'delete'])->name('delete.event');
    Route::get('/update-event/{id}', [EventsController::class, 'edit'])->name('update-event');
    Route::put('/update-event/{event}', [EventsController::class, 'update'])->name('update.event');
    Route::get('/update-announcement/{id}', [EventsController::class, 'editAnn'])->name('update-ann');
    Route::put('/update-announcement/{announcement}', [EventsController::class, 'updateAnn'])->name('update.ann');
    Route::delete('/update-announcement/{id}', [EventsController::class, 'deleteAnn'])->name('delete.ann');



    Route::get('/jobs', [JobsController::class, 'jobs'])->name('jobs'); //pagshoshow ng jobs
    Route::get('/jobs/job-post', [JobsController::class, 'jobPost'])->name('job-post'); //pagcecreate ng jobs
    Route::post('/jobs/job-post', [JobsController::class, 'store'])->name('job.store'); //pagsstore ng jobs
    Route::get('/jobs/{job}', [JobsController::class, 'show'])->name('jobs.show');
    Route::put('/jobs/{job}', [JobsController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobsController::class, 'deleteJob'])->name('delete.job');
    Route::get('/job-location', [JobsController::class, 'showLocationComponent'])->name('job-location.component');
    Route::post('/job-location/store', [JobsController::class, 'storeLocation'])->name('job-location.store');
    Route::get('/job-post', [JobsController::class, 'showJobPost'])->name('job-post.show');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/gallery/add-gallery', [GalleryController::class, 'create'])->name('gallery.add');
    Route::post('/gallery/add-gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/update-gallery/{gallery}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/update-gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/update-gallery/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');

    Route::get('/user-profile', [ProfileController::class, 'index'])->name('user-profile');
    Route::get('/show-profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('/user-analytics', [AnalyticsController::class, 'getUserAnalytics']);
    Route::get('/user-employment-analytics', [AnalyticsController::class, 'getUserEmploymentAnalytics']);
    Route::get('/user-aligned-analytics', [AnalyticsController::class, 'alignUsersToCourse']);
    Route::get('/user-owned-business', [AnalyticsController::class, 'isOwnedBusiness']);
    Route::get('/salary-range', [AnalyticsController::class, 'getSalaryRange']);
    Route::get('/user-locations', [AnalyticsController::class, 'getLocation']);
    Route::get('/all-users', [AnalyticsController::class, 'getAllUsers'])->middleware('user.type');
    Route::get('/all-degrees', [AnalyticsController::class, 'getAllDegrees']);
    Route::get('/analytics/generate-pdf', [AnalyticsController::class, 'pdfPreview'])->name('generate-pdf.show');
    Route::get('/generate-pdf', [AnalyticsController::class, 'PDFgeneration'])->name('generate.pdf');

    // Route::put('/approvals/{userId}', [ApprovalsController::class, 'approveUser'])->name('user.approve');

    Route::get('/administration', [AdminController::class, 'index'])->name('administration.show');
    Route::put('/administration/{userId}', [AdminController::class, 'approveUser'])->name('user.approve');
    Route::post('/administration', [AdminController::class, 'createAccount'])->name('user.create');
    Route::post('/administration/{id}', [AdminController::class, 'approveGallery'])->name('gallery.approve');
    Route::delete('/administration/{id}', [AdminController::class, 'deleteGallery'])->name('gallery.deletee');
    Route::post('/job-approvals/{id}', [AdminController::class, 'approveJob'])->name('job.approve');
    Route::delete('/job-approvals/{id}', [AdminController::class, 'deleteJob'])->name('job.delete');
    Route::post('/update-role', [AdminController::class, 'updateRole'])->name('updateRole')->middleware('superadmin');

    Route::post('/like', [ReactionController::class, 'like'])->name('like');

    Route::get('/align-users-to-course', [AnalyticsController::class, 'alignUsersToCourse'])->name('align.users.to.course');

    Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password.show');
    Route::put('/update-password', [ChangePasswordController::class, 'updatePassword'])->name('update.password');

    Route::post('/end-employment', [EmploymentHistoryController::class, 'endEmployment']);
    Route::get('/employment-history', [EmploymentHistoryController::class, 'index'])->name('employment-history.show');
    Route::delete('/employment-history/{id}', [EmploymentHistoryController::class, 'destroy'])->name('employment.history.destroy');
    Route::get('/add-past-employment', [EmploymentHistoryController::class, 'addPastEmployment'])->name('add-past-employment.show');
    Route::post('/add-past-employment', [EmploymentHistoryController::class, 'store'])->name('employment.history.store');

});


