<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\SaaS\DashboardController as SaaSDashboardController;
use App\Http\Controllers\SaaS\AgencyController as SaaSAgencyController;
use App\Http\Controllers\SaaS\PlanController;
use App\Http\Controllers\SaaS\ThemeController;
use App\Http\Controllers\SaaS\SettingsController as SaaSSettingsController;
use App\Http\Controllers\Agency\DashboardController as AgencyDashboardController;
use App\Http\Controllers\Agency\RealtorController;
use App\Http\Controllers\Agency\LeadController;
use App\Http\Controllers\Agency\ClientController;
use App\Http\Controllers\Agency\PropertyController;
use App\Http\Controllers\Agency\TransactionController;
use App\Http\Controllers\Agency\DocumentController;
use App\Http\Controllers\Agency\BranchController;
use App\Http\Controllers\Agency\WebsiteController;
use App\Http\Controllers\Agency\PaymentController as AgencyPaymentController;
use App\Http\Controllers\Agency\ReportController;
use App\Http\Controllers\Agency\SettingsController as AgencySettingsController;
use App\Http\Controllers\Realtor\DashboardController as RealtorDashboardController;
use App\Http\Controllers\Realtor\LeadController as RealtorLeadController;
use App\Http\Controllers\Realtor\ClientController as RealtorClientController;
use App\Http\Controllers\Realtor\PropertyController as RealtorPropertyController;
use App\Http\Controllers\Realtor\CommissionController;
use App\Http\Controllers\Realtor\DocumentController as RealtorDocumentController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\PropertyController as ClientPropertyController;
use App\Http\Controllers\Client\DocumentController as ClientDocumentController;
use App\Http\Controllers\Client\PaymentController as ClientPaymentController;
use App\Http\Controllers\Client\SupportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // Authentication Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Redirect to role-specific dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();

        return match($user->role) {
            'super_admin' => redirect()->route('saas.dashboard'),
            'agency_admin' => redirect()->route('agency.dashboard'),
            'realtor' => redirect()->route('realtor.dashboard'),
            'client' => redirect()->route('client.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

    // SaaS Owner Routes
    Route::middleware(['role:super_admin'])->prefix('saas')->name('saas.')->group(function () {
        Route::get('/dashboard', [SaaSDashboardController::class, 'index'])->name('dashboard');
        Route::resource('agencies', SaaSAgencyController::class);
        Route::resource('plans', PlanController::class);
        Route::resource('themes', ThemeController::class);
        Route::get('/settings', [SaaSSettingsController::class, 'index'])->name('settings');
        Route::put('/settings', [SaaSSettingsController::class, 'update'])->name('settings.update');
    });

    // Agency Routes
    Route::middleware(['role:agency_admin,realtor', 'tenant'])->prefix('agency')->name('agency.')->group(function () {
        Route::get('/dashboard', [AgencyDashboardController::class, 'index'])->name('dashboard');
        Route::resource('realtors', RealtorController::class)->middleware('role:agency_admin');
        Route::resource('leads', LeadController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('properties', PropertyController::class);
        Route::resource('transactions', TransactionController::class)->middleware('role:agency_admin');
        Route::resource('documents', DocumentController::class);
        Route::resource('branches', BranchController::class)->middleware('role:agency_admin');
        Route::prefix('website')->name('website.')->middleware('role:agency_admin')->group(function () {
            Route::get('/', [WebsiteController::class, 'index'])->name('index');
            Route::get('/pages', [WebsiteController::class, 'pages'])->name('pages');
            Route::get('/themes', [WebsiteController::class, 'themes'])->name('themes');
            Route::post('/pages', [WebsiteController::class, 'storePage'])->name('pages.store');
        });
        Route::resource('payments', AgencyPaymentController::class)->middleware('role:agency_admin');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('role:agency_admin');
        Route::get('/settings', [AgencySettingsController::class, 'index'])->name('settings')->middleware('role:agency_admin');
        Route::put('/settings', [AgencySettingsController::class, 'update'])->name('settings.update')->middleware('role:agency_admin');
    });

    // Realtor Routes
    Route::middleware(['role:realtor', 'tenant'])->prefix('realtor')->name('realtor.')->group(function () {
        Route::get('/dashboard', [RealtorDashboardController::class, 'index'])->name('dashboard');
        Route::get('/leads', [RealtorLeadController::class, 'index'])->name('leads.index');
        Route::get('/clients', [RealtorClientController::class, 'index'])->name('clients.index');
        Route::get('/properties', [RealtorPropertyController::class, 'index'])->name('properties.index');
        Route::resource('commissions', CommissionController::class);
        Route::resource('documents', RealtorDocumentController::class);
    });

    // Client Routes
    Route::middleware(['role:client', 'tenant'])->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
        Route::get('/properties', [ClientPropertyController::class, 'index'])->name('properties.index');
        Route::resource('documents', ClientDocumentController::class);
        Route::resource('payments', ClientPaymentController::class);
        Route::get('/support', [SupportController::class, 'index'])->name('support');
        Route::post('/support', [SupportController::class, 'store'])->name('support.store');
    });
});
