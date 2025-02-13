<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogControl;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Blog Routes
Route::get('/blogs', [BlogControl::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogControl::class, 'create'])->name('blogs.create');
Route::post('/blogs', [BlogControl::class, 'store'])->name('blogs.store');
Route::get('/blogs/{id}', [BlogControl::class, 'show'])->name('blogs.show');
Route::get('/blogs/{id}/edit', [BlogControl::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{id}', [BlogControl::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{id}', [BlogControl::class, 'destroy'])->name('blogs.destroy');
Route::post('/blogs/{id}/restore', [BlogControl::class, 'restore'])->name('blogs.restore'); // Add restore route
Route::delete('/blogs/{id}/forceDelete', [BlogControl::class, 'forceDelete'])->name('blogs.forceDelete'); // Add force delete route
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
