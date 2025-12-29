<?php

use App\Http\Controllers\View\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::patch('/form/settings/update/{setting}', [DashboardController::class, 'updateSetting'])->name('admin.web.settings.update');

Route::post('/form/roles/store', [DashboardController::class, 'storeRole'])->name('admin.web.roles.store');
Route::patch('/form/roles/update/{role}', [DashboardController::class, 'updateRole'])->name('admin.web.roles.update');
Route::delete('/form/roles/delete/{role}', [DashboardController::class, 'deleteRole'])->name('admin.web.roles.delete');
