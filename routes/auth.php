<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function(){
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('update', [RegisteredUserController::class, 'update']);
});

Route::middleware('auth')->group(function(){
    Route::get('create-email', [EmailController::class, 'create'])->name('email-create');
    Route::post('create-email', [EmailController::class, 'store'])->name('email-send');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});

Route::middleware('guest')->group(function(){
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

