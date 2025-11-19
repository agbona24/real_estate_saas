<?php

use App\Http\Controllers\Agency\DashboardController;
use App\Http\Controllers\Agency\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Agency Portal Routes
Route::prefix('agency')->name('agency.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Management (for admin configuration)
    Route::resource('menus', MenuController::class);
});
