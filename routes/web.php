<?php

use App\Http\Controllers\Admin\ProposalReviewController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\SuperAdmin\CmsController;
use App\Http\Controllers\SuperAdmin\UserManagementController;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $settings = Setting::pluck('value', 'key')->toArray();

    return view('welcome', compact('settings'));
});

// MATIKAN AUTH ROUTES BAWAAN LARAVEL (EMAIL/PASSWORD)
// Auth::routes();

// --- ROUTE AUTENTIKASI OTP (MENGGANTIKAN BAWAAN LARAVEL) ---

// 1. Route Logout (Wajib ada agar user bisa keluar)
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// 2. Route Login diarahkan ke form Nomor HP OTP
Route::get('/login', [OtpController::class, 'showPhoneForm'])->name('login');
Route::get('/login-otp', [OtpController::class, 'showPhoneForm'])->name('otp.login');

// 3. Proses OTP
Route::post('/login-otp/generate', [OtpController::class, 'generate'])->name('otp.generate');
Route::get('/login-otp/verify', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
Route::post('/login-otp/verify', [OtpController::class, 'authenticate'])->name('otp.authenticate');

// 4. Redirect Register ke Login (Karena OTP menggabungkan Register & Login)
Route::get('/register', function () {
    return redirect()->route('login');
})->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// APPLICANT ROUTES
Route::middleware(['auth'])->group(function () {
    Route::resource('proposals', ProposalController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('proposals', ProposalController::class);

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ADMIN ROUTES (Protected by Auth AND Role middleware)
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/proposals', [ProposalReviewController::class, 'index'])->name('proposals.index');
    Route::get('/proposals/{proposal}', [ProposalReviewController::class, 'show'])->name('proposals.show');
    Route::patch('/proposals/{proposal}/status', [ProposalReviewController::class, 'updateStatus'])->name('proposals.update-status');
});

// SUPER ADMIN ONLY
Route::middleware(['auth', 'role:super_admin'])->prefix('superadmin')->name('superadmin.')->group(function () {

    // FIXED: Point this to the DashboardController, NOT UserManagement
    Route::get('/dashboard', [App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('dashboard');

    // User & Role Management
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.update-role');
    Route::patch('/users/{user}/status', [UserManagementController::class, 'toggleStatus'])->name('users.toggle-status');

    // Landing Page CMS
    Route::get('/cms', [CmsController::class, 'index'])->name('cms.index');

    // FIXED: Removed the extra 'superadmin' prefix/name so it doesn't double up
    Route::patch('/cms/update', [CmsController::class, 'update'])->name('cms.update');
});
