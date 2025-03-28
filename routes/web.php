<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile.update');
});

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');

    Route::post('/subscribe', [BlogController::class, 'subscribe'])->name('blog.subscribe');
});
