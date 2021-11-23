<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
})->name('home');

Route::get('/blog', function () {
    return inertia('Blog');
})->name('blog');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
