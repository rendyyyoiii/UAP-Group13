<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;  
use App\Http\Controllers\Auth\RegisteredUserController; 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;  
use App\Http\Controllers\CategoryController;  
use App\Http\Controllers\TagController;  

Route::get('/login', [AuthenticatedSessionController::class, 'create'])  
    ->name('login');  

Route::post('/login', [AuthenticatedSessionController::class, 'store']);  

Route::get('/register', [RegisteredUserController::class, 'create'])  
    ->name('register');  

Route::post('/register', [RegisteredUserController::class, 'store']);  

Route::get('/', function () {
    return view('welcome');
});

Route::resource('articles', ArticleController::class)->middleware('auth');  

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('articles', ArticleController::class);  
    Route::resource('categories', CategoryController::class);  
    Route::resource('tags', TagController::class);
});
   
require __DIR__.'/auth.php';
