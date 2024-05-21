<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'showAll']);

Route::resource('/post', PostController::class);
    // ->middleware('auth');

Route::get('/profile', function () {
    return view('profile', [
        'title' => 'Profile',
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'title' => 'Dashboard',
    ]);
});

Route::get('/logout', function () {
    return 0;
});
