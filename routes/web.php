<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tenant/Agency Routes (for agency_admin role)
    Route::prefix('tenant')->name('tenant.')->group(function () {
        // Properties Management
        Route::resource('properties', \App\Http\Controllers\Tenant\PropertyController::class);

        // Leads Management
        Route::resource('leads', \App\Http\Controllers\Tenant\LeadController::class);

        // Clients Management
        Route::resource('clients', \App\Http\Controllers\Tenant\ClientController::class);

        // Estates Management
        Route::resource('estates', \App\Http\Controllers\Tenant\EstateController::class);
        Route::get('estates/{id}/plots', [\App\Http\Controllers\Tenant\EstateController::class, 'plots'])->name('estates.plots');
        Route::get('estates/{id}/allocate', [\App\Http\Controllers\Tenant\EstateController::class, 'allocate'])->name('estates.allocate');

        // Transactions
        Route::get('transactions', [\App\Http\Controllers\Tenant\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('transactions/{id}', [\App\Http\Controllers\Tenant\TransactionController::class, 'show'])->name('transactions.show');
        Route::put('transactions/{id}', [\App\Http\Controllers\Tenant\TransactionController::class, 'update'])->name('transactions.update');

        // Payments
        Route::get('payments/schedule', [\App\Http\Controllers\Tenant\PaymentController::class, 'schedule'])->name('payments.schedule');
        Route::get('payments/record', [\App\Http\Controllers\Tenant\PaymentController::class, 'record'])->name('payments.record');
        Route::post('payments', [\App\Http\Controllers\Tenant\PaymentController::class, 'store'])->name('payments.store');
        Route::get('payments/{id}/receipt', [\App\Http\Controllers\Tenant\PaymentController::class, 'receipt'])->name('payments.receipt');

        // Realtors/Agents Management
        Route::resource('realtors', \App\Http\Controllers\Tenant\RealtorController::class);

        // Website Builder
        Route::get('website/builder', [\App\Http\Controllers\Tenant\WebsiteController::class, 'builder'])->name('website.builder');
        Route::put('website', [\App\Http\Controllers\Tenant\WebsiteController::class, 'update'])->name('website.update');

        // Subscription Management
        Route::get('subscription', [\App\Http\Controllers\Tenant\SubscriptionController::class, 'index'])->name('subscription.index');
        Route::put('subscription', [\App\Http\Controllers\Tenant\SubscriptionController::class, 'update'])->name('subscription.update');
    });
});
