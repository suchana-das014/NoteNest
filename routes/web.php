<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\welcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

// Welcome page at root
Route::get('/', [welcomeController::class, 'welcome'])->name('welcome');

// Notes (auth required)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('notes', NoteController::class);
});

// /dashboard kept as alias for any old links
Route::get('/dashboard', fn () => redirect()->route('notes.index'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';