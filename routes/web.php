<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
    ]);
});
Route::get('/post', function () {
    return view('home', [
        'title' => 'Your Posts',
    ]);
});
Route::get('/post/{id}', function () {
    return view('home', [
        'title' => 'Your Posts',
    ]);
});
Route::get('/profile', function () {
    return view('home', [
        'title' => 'Profile',
    ]);
});
Route::get('/dashboard', function () {
    return view('home', [
        'title' => 'Dashboard',
    ]);
});
Route::get('/dashboard/user', function () {
    return view('home', [
        'title' => 'User',
    ]);
});
Route::get('/dashboard/user/{id}', function () {
    return view('home', [
        'title' => 'User',
    ]);
});
Route::get('/dashboard/post', function () {
    return view('home', [
        'title' => 'Posts',
    ]);
});
Route::get('/dashboard/post/{id}', function () {
    return view('home', [
        'title' => 'Posts',
    ]);
});
Route::get('/logout', function () {
    return 0;
});
