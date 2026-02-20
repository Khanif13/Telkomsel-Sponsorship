<?php

use App\Http\Controllers\Admin\ProposalReviewController;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Protect these routes with the 'auth' middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('proposals', ProposalController::class);
});

// ADMIN ROUTES (Protected by Auth AND Role check)
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->name('admin.')->group(function () {

    // View all incoming proposals
    Route::get('/proposals', [ProposalReviewController::class, 'index'])->name('proposals.index');

    // Update the status of a specific proposal
    Route::patch('/proposals/{proposal}/status', [ProposalReviewController::class, 'updateStatus'])->name('proposals.update-status');
});
