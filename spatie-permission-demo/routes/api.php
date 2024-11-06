<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/articles', [ArticleController::class, 'index']);
// });

Route::get('articles', [ArticleController::class, 'index'])->name('api.articles.index');
Route::post('articles', [ArticleController::class, 'store'])->name('api.articles.store');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('api.articles.show');
Route::put('articles/{article}', [ArticleController::class, 'update'])->name('api.articles.update');
Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('api.articles.destroy');

Route::post('login', [AuthController::class, 'apiLogin']);