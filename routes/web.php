<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');       // da sostituire con 'movies'
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Middleware personalizzato con nome "admin" e prefisso url "admin/" dove ci raggruppo varie:
Route::middleware('auth', 'verified')
    ->name("admin.")
    ->prefix("admin")
    ->group(function () {
        // rotta "/admin" (all'inizio era /admin/index)" con nome "index"
        Route::get('/', [DashboardController::class, "index"])->name("index");
        // rotta "/admin/profile" con nome "profile"
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    });

require __DIR__ . '/auth.php';