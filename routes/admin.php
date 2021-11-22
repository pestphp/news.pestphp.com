<?php

use App\Http\Controllers\Admin\Preview\PreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/preview/{article:slug}', PreviewController::class)->name('preview');
