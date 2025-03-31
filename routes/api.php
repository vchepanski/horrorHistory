<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\Api\V1\StoryController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\Admin\AdminStoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::get('/stories', [StoryController::class, 'index']);
    Route::get('/story/{id}', [StoryController::class, 'show']); // ⬅️ NOVA ROTA
    Route::post('/story', [StoryController::class, 'store']);
});
Route::prefix('v1')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
});


Route::prefix('v1/admin')->group(function () {
    Route::get('/historias', [AdminStoryController::class, 'index']);
    Route::put('/historias/{id}/approve', [AdminStoryController::class, 'approve']);
    Route::delete('/historias/{id}', [AdminStoryController::class, 'destroy']);
});

Route::prefix('v1')->group(function () {
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}/toggle-status', [CategoryController::class, 'toggleStatus']);
});
