<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Story;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', function () {
    return Category::select('id', 'name')->get();
});

Route::get('/stories', function () {
    return Story::with('category')
        ->where('is_published', true)
        ->orderBy('created_at', 'desc')
        ->get(['id', 'title', 'content', 'category_id']);
});
