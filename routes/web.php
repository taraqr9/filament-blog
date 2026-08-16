<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Livewire\BlogPreviewComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile.update');

    Route::get('/live-preview', BlogPreviewComponent::class);
});

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/audio/{blogAudio}', [BlogController::class, 'audio'])->name('blog.audio');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
});

Route::get('/about', [HomeController::class, 'about'])->name('about');
