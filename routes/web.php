<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\View\ProjectViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [UserSettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [UserSettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [UserSettingsController::class, 'destroy'])->name('settings.destroy');

    Route::get('/projects/create', [ProjectViewController::class, 'create'])->name('projects.create');
    Route::post('/projects/save', [ProjectViewController::class, 'store'])->name('projects.store');
    Route::get('/projects/view/{project}', [ProjectViewController::class, 'viewSingle'])->name('projects.view');

    Route::prefix('admin')->middleware('admin')->group(function () {
        include __DIR__.'/admin.php';
    });
});

require __DIR__.'/auth.php';
