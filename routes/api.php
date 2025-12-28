<?php

use App\Http\Controllers\BugController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['status' => 'ok']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('bugs', BugController::class);
    Route::apiResource('comments', CommentController::class);
    Route::apiResource('tags', TagController::class);

    Route::get('projects/{project}/bugs', [ProjectController::class, 'bugs']);
    Route::post('bugs/{bug}/tags/{tag}', [BugController::class, 'attachTag']);
    Route::delete('bugs/{bug}/tags/{tag}', [BugController::class, 'detachTag']);
});
