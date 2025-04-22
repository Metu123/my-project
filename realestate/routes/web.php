<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\TestSearchController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ClickTrackController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminAuthController;

// Authentication Routes
Route::post('/signup', [AutoController::class, 'register'])->name('signup');
Route::post('/login', [AutoController::class, 'login'])->name('login');
Route::get('/logout', [AutoController::class, 'logout'])->name('logout');

// Static Pages
Route::view('/contactus', 'contact');
Route::view('/about', 'aboutus');
Route::view('/faq', 'faq');
Route::view('/privacy', 'privacy');
Route::view('/terms', 'termsandcondition');

// Search Processing and Display Results
Route::get('/testsearch', [TestSearchController::class, 'search']);

// Email Verification Routes
Route::get('/verify-email', [VerificationController::class, 'showVerificationPage'])->name('verify.email');
Route::get('/send-verification-email', [VerificationController::class, 'sendVerificationEmail'])->name('send.verify.email');
Route::get('/verify-email/{token}', [VerificationController::class, 'verifyEmail'])->name('verify.email.token');

// Main Page Route
Route::view('/', 'index');

// Property Routes (Protected)
Route::middleware('auth.session')->group(function () {
    Route::get('/property/create', [PropertyController::class, 'create'])->name('property.create');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
});

// Single Property Display
Route::get('/property/{id}', [SingleController::class, 'show'])->name('property.show');

// Dashboard Routes
Route::middleware('auth.session')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('/dashboard/delete/{id}', [DashboardController::class, 'delete'])->name('dashboard.delete');
});

// Update Property
Route::middleware('auth.session')->group(function () {
    Route::get('/property/update/{id}', [UpdateController::class, 'edit'])->name('property.edit');
    Route::post('/property/update/{id}', [UpdateController::class, 'update'])->name('property.update');
});

// Favorite Routes
Route::middleware('auth.session')->group(function () {
    Route::get('/favourite', [FavoriteController::class, 'index'])->name('favourite.index');
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
});

// Profile Routes
Route::middleware('auth.session')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
});

// Agent Routes
Route::get('/agent/{username}', [AgentController::class, 'showAgentProfile']);

// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

// Click Tracking
Route::get('/track-click/{id}', [ClickTrackController::class, 'trackClick']);

// Report Routes
Route::get('/report/{property_id}', [ReportController::class, 'showReportForm']);
Route::post('/report/{property_id}', [ReportController::class, 'submitReport']);

// Admin Routes
Route::middleware('auth.session')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admindashboard');
    Route::delete('/admin/dashboard/delete/{id}', [AdminDashboardController::class, 'delete'])->name('admindashboard.delete');

    Route::get('/admin/users', [UserController::class, 'index']);
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);

    Route::get('/admin/reports', [AdminReportController::class, 'showReportTable'])->name('admin.reports');
    Route::delete('/admin/reports/{id}', [AdminReportController::class, 'deleteReport'])->name('admin.reports.delete');
});

// Admin Authentication Routes
Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm']);
Route::post('/admin/register', [AdminAuthController::class, 'register']);

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::get('/admin/logout', [AdminAuthController::class, 'logout']);


Route::fallback(function () {

return response()->view('errors.404', [], 404);

});

Route::get('/errors/404', function () {
    return view('errors.404');
});
