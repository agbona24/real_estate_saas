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

    // Team Management
    Route::get('/team', [App\Http\Controllers\Agency\TeamController::class, 'index'])->name('team.index');
    Route::get('/team/performance', [App\Http\Controllers\Agency\TeamController::class, 'performance'])->name('team.performance');
    Route::get('/team/roles', [App\Http\Controllers\Agency\TeamController::class, 'roles'])->name('team.roles');
    Route::get('/team/activity-logs', [App\Http\Controllers\Agency\TeamController::class, 'activityLogs'])->name('team.activity-logs');

    // CRM
    Route::get('/crm/leads', [App\Http\Controllers\Agency\CrmController::class, 'leads'])->name('crm.leads');
    Route::get('/crm/clients', [App\Http\Controllers\Agency\CrmController::class, 'clients'])->name('crm.clients');
    Route::get('/crm/follow-ups', [App\Http\Controllers\Agency\CrmController::class, 'followUps'])->name('crm.follow-ups');
    Route::get('/crm/tasks', [App\Http\Controllers\Agency\CrmController::class, 'tasks'])->name('crm.tasks');
    Route::get('/crm/appointments', [App\Http\Controllers\Agency\CrmController::class, 'appointments'])->name('crm.appointments');

    // Properties
    Route::get('/properties', [App\Http\Controllers\Agency\PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/create', [App\Http\Controllers\Agency\PropertyController::class, 'create'])->name('properties.create');
    Route::get('/properties/categories', [App\Http\Controllers\Agency\PropertyController::class, 'categories'])->name('properties.categories');
    Route::get('/properties/estates', function() { return view('agency.properties.estates'); })->name('properties.estates');

    // Sales & Deals
    Route::get('/sales/transactions', [App\Http\Controllers\Agency\SalesController::class, 'transactions'])->name('sales.transactions');
    Route::get('/sales/offers', [App\Http\Controllers\Agency\SalesController::class, 'offers'])->name('sales.offers');
    Route::get('/sales/allocations', [App\Http\Controllers\Agency\SalesController::class, 'allocations'])->name('sales.allocations');
    Route::get('/sales/reservations', [App\Http\Controllers\Agency\SalesController::class, 'reservations'])->name('sales.reservations');
    Route::get('/sales/installment-plans', [App\Http\Controllers\Agency\SalesController::class, 'installmentPlans'])->name('sales.installment-plans');
    Route::get('/sales/commissions', [App\Http\Controllers\Agency\SalesController::class, 'commissions'])->name('sales.commissions');
    Route::get('/sales/closing-reports', [App\Http\Controllers\Agency\SalesController::class, 'closingReports'])->name('sales.closing-reports');

    // Settings
    Route::get('/settings/profile', [App\Http\Controllers\Agency\SettingsController::class, 'profile'])->name('settings.profile');
    Route::get('/settings/branding', [App\Http\Controllers\Agency\SettingsController::class, 'branding'])->name('settings.branding');
    Route::get('/settings/subscription', [App\Http\Controllers\Agency\SettingsController::class, 'subscription'])->name('settings.subscription');
    Route::get('/settings/users', [App\Http\Controllers\Agency\SettingsController::class, 'users'])->name('settings.users');
    Route::get('/settings/payment', [App\Http\Controllers\Agency\SettingsController::class, 'payment'])->name('settings.payment');
    Route::get('/settings/security', [App\Http\Controllers\Agency\SettingsController::class, 'security'])->name('settings.security');
    Route::get('/settings/audit-logs', [App\Http\Controllers\Agency\SettingsController::class, 'auditLogs'])->name('settings.audit-logs');
    Route::get('/settings/notifications', [App\Http\Controllers\Agency\SettingsController::class, 'notifications'])->name('settings.notifications');

    // Reports & Analytics
    Route::get('/reports', [App\Http\Controllers\Agency\ReportsController::class, 'index'])->name('reports.index');
    Route::get('/reports/sales', [App\Http\Controllers\Agency\ReportsController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/agent-performance', [App\Http\Controllers\Agency\ReportsController::class, 'agentPerformance'])->name('reports.agent-performance');
    Route::get('/reports/property-performance', [App\Http\Controllers\Agency\ReportsController::class, 'propertyPerformance'])->name('reports.property-performance');
    Route::get('/reports/financial', [App\Http\Controllers\Agency\ReportsController::class, 'financial'])->name('reports.financial');

    // Menu Management (for admin configuration)
    Route::resource('menus', MenuController::class);
});
