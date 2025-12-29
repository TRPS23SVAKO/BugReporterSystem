<?php

use App\Http\Controllers\Api\BugController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['status' => 'ok']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class)->names('api.projects');
    Route::apiResource('bugs', BugController::class)->names('api.bugs');
    Route::apiResource('comments', CommentController::class)->names('api.comments');
    Route::apiResource('tags', TagController::class)->names('api.tags');

    Route::get('projects/{project}/bugs', [ProjectController::class, 'bugs'])->name('api.projects.bugs');
    Route::post('bugs/{bug}/tags/{tag}', [BugController::class, 'attachTag'])->name('api.bugs.tags.attach');
    Route::delete('bugs/{bug}/tags/{tag}', [BugController::class, 'detachTag'])->name('api.bugs.tags.detach');
});
