<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ServiceController::class, 'index'])->name('status.index');

Route::get('api/services', [ServiceController::class, 'indexApi']);

Route::resource('services', ServiceController::class);
