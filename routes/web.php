<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ImageController::class, 'index']);
Route::post('upload', [ImageController::class, 'upload'])->name('image.store');

