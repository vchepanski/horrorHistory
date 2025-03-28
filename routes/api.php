<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\Api\V1\StoryController;
use App\Http\Controllers\Api\V1\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::get('/stories', [StoryController::class, 'index']);
    Route::post('/story', [StoryController::class, 'store']);
    Route::get('/categories', [CategoryController::class, 'index']);
});
