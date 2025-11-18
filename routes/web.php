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

    // Realtor Routes
    Route::prefix('realtor')->name('realtor.')->group(function () {
        Route::get('/leads', function() { return view('realtor.leads.index'); })->name('leads.index');
        Route::get('/clients', function() { return view('realtor.clients.index'); })->name('clients.index');
        Route::get('/properties', function() { return view('realtor.properties.index'); })->name('properties.index');
        Route::get('/appointments', function() { return view('realtor.appointments.index'); })->name('appointments.index');
    });

    // Agency Routes
    Route::prefix('agency')->name('agency.')->group(function () {
        Route::resource('properties', 'PropertyController');
        Route::resource('agents', 'AgentController');
        Route::resource('leads', 'LeadController');
        Route::resource('users', 'UserController');
        Route::get('/reports', function() { return view('agency.reports.index'); })->name('reports.index');
        Route::get('/properties', function() { return view('agency.properties.index'); })->name('properties.index');
        Route::get('/agents', function() { return view('agency.agents.index'); })->name('agents.index');

        // Form submission routes (for slide-out panels)
        Route::post('/properties/store', function() { return redirect()->back()->with('success', 'Property created successfully'); })->name('properties.store');
        Route::post('/users/store', function() { return redirect()->back()->with('success', 'Agent invited successfully'); })->name('users.store');
        Route::post('/leads/store', function() { return redirect()->back()->with('success', 'Lead created successfully'); })->name('leads.store');
    });

    // Client Routes
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/properties/browse', function() { return view('client.properties.browse'); })->name('properties.browse');
        Route::get('/properties/my', function() { return view('client.properties.my'); })->name('properties.my');
        Route::get('/documents', function() { return view('client.documents.index'); })->name('documents.index');
    });

    // Super Admin Routes
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/agencies', function() { return view('superadmin.agencies.index'); })->name('agencies.index');
        Route::get('/users', function() { return view('superadmin.users.index'); })->name('users.index');
        Route::get('/analytics', function() { return view('superadmin.analytics.index'); })->name('analytics.index');
        Route::get('/settings', function() { return view('superadmin.settings.index'); })->name('settings.index');

        // Form submission routes (for slide-out panels)
        Route::post('/agencies/store', function() { return redirect()->back()->with('success', 'Agency created successfully'); })->name('agencies.store');
    });
});
