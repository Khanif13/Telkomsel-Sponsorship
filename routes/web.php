<?php

use App\Http\Controllers\Admin\ProposalReviewController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\SuperAdmin\UserManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// APPLICANT ROUTES
Route::middleware(['auth'])->group(function () {
    Route::resource('proposals', ProposalController::class);
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
    Route::get('/cms', [App\Http\Controllers\SuperAdmin\CmsController::class, 'index'])->name('cms.index');
    Route::post('/cms/update', [App\Http\Controllers\SuperAdmin\CmsController::class, 'update'])->name('cms.update');
});
