<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::redirect('/login', '/wink/login')->name('login');

Route::get('/blog', function () {
    return inertia('Blog');
})->name('blog');

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
