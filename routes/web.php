<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])
    ->name('home');

Route::post('/register', [UserController::class, 'store'])
    ->name('register.store');
Route::get('/register', [UserController::class, 'create'])
    ->name('register')
    ->middleware('guest');
    
Route::get('/login', [UserController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate'])
    ->name('login.auth');
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');

Route::get('/profile/{user:username}', [UserController::class, 'edit'])
    ->name('profile.edit');
Route::put('/profile/{user:username}', [UserController::class, 'update'])
    ->name('profile.update');

Route::get('/post/create', [PostController::class, 'create'])
    ->name('post.create');
Route::post('/post', [PostController::class, 'store'])
    ->name('post.store');
Route::delete('/post/{post}', [PostController::class, 'destroy'])
    ->name('post.destroy');
Route::get('/post/{user:username}', [PostController::class, 'index'])
    ->name('post.index');
Route::get('/post/{user:username}/{post}', [PostController::class, 'show'])
    ->name('post.show');

Route::post('/comment', [CommentController::class, 'store'])
    ->name('comment.store');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])
    ->name('comment.destroy');

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'Dashboard',
    ]);
    })
    ->name('dashboard')    
    ->middleware('auth');

// Route::resource('/dashboard/comment', CommentController::class)
//     ->middleware('auth');

// Route::resource('/dashboard/post', PostController::class)
//     ->middleware('auth');
