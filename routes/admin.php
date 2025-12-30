<?php

use App\Http\Controllers\View\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::prefix('forms')->group(function () {
    Route::patch('/settings/update/{setting}', [DashboardController::class, 'updateSetting'])->name('admin.web.settings.update');

    Route::post('/roles/store', [DashboardController::class, 'storeRole'])->name('admin.web.roles.store');
    Route::patch('/roles/update/{role}', [DashboardController::class, 'updateRole'])->name('admin.web.roles.update');
    Route::delete('/roles/delete/{role}', [DashboardController::class, 'deleteRole'])->name('admin.web.roles.delete');

    Route::post('/bug-statuses', [DashboardController::class, 'storeBugStatus'])->name('admin.web.bug-statuses.store');
    Route::patch('/bug-statuses/{bugStatus}', [DashboardController::class, 'updateBugStatus'])->name('admin.web.bug-statuses.update');
    Route::delete('/bug-statuses/{bugStatus}', [DashboardController::class, 'destroyBugStatus'])->name('admin.web.bug-statuses.destroy');
});
