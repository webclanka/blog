<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Redirect root to posts index
Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Post routes
Route::resource('posts', PostController::class);

// Additional post actions
Route::post('posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
Route::post('posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');
Route::post('posts/{post}/duplicate', [PostController::class, 'duplicate'])->name('posts.duplicate');
