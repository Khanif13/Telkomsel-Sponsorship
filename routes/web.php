<?php

use App\Http\Controllers\Admin\ProposalReviewController;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route; // Tambahkan ini di atas

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
