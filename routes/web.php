<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::redirect('/login', '/wink/login')->name('login');

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])
    ->middleware('throttle:subscriptions')
    ->name('subscribe');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog', [PostController::class, 'index'])->name('blog');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
