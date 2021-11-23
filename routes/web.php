<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
})->name('home');

Route::get('/blog', function () {
    return inertia('Blog');
})->name('blog');

Route::get('/blog/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
