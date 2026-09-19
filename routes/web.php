<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ServiceController::class, 'index'])->name('status.index');

Route::resource('services', ServiceController::class);
