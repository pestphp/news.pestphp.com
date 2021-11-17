<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
})->name('home');

Route::get('/blog', function () {
    return inertia('Blog');
})->name('blog');
