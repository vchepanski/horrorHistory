<?php

use App\Http\Controllers\HistorysController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return 'Bem-vindo ao sistema!';
})->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//ROTAS DE USUARIOS:
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'read'])->name('user.read');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

});
Route::prefix('site')->group(function(){
    Route::get('/', [SiteController::class, 'index'])->name('site.index');
});
Route::prefix('stories')->group(function(){
Route::get('/', [HistorysController::class, 'index'])->name('stories.index');
Route::get('/postar-historia', [HistorysController::class, 'create'])->name('historia.create');
Route::post('/postar-historia', [HistorysController::class, 'store'])->name('historia.store');

});

