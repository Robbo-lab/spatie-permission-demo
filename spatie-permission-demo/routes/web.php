<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('dashboard/users', UserController::class);
Route::redirect('/dashboard', '/dashboard/users');

Route::post('users/{user}/permissions', [UserController::class, 'updatePermissions'])->name('users.updatePermissions');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('articles', ArticleController::class);