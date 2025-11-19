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

    // Menu Management (for admin configuration)
    Route::resource('menus', MenuController::class);
});
