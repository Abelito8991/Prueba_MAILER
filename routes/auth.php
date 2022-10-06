<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('register', [RegisteredUserController::class, 'create'])->middleware('admin')
            ->name('register');

Route::post('register', [RegisteredUserController::class, 'store'])->middleware('admin');
Route::post('update', [RegisteredUserController::class, 'update'])->middleware('admin');

Route::get('create-email', [EmailController::class, 'create'])->middleware('auth')->name('email-create');
Route::post('create-email', [EmailController::class, 'store'])->middleware('auth')->name('email-send');

Route::get('login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')
            ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

// Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//             ->name('password.request');

// Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//             ->name('password.email');

// Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//             ->name('password.reset');

// Route::post('reset-password', [NewPasswordController::class, 'store'])
//             ->name('password.update');


// Route::middleware('auth')->group(function () {
//     // Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
//     //             ->name('verification.notice');

//     // Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//     //             ->middleware(['signed', 'throttle:6,1'])
//     //             ->name('verification.verify');

//     // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//     //             ->middleware('throttle:6,1')
//     //             ->name('verification.send');

//     // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
//     //             ->name('password.confirm');

//     // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

// });
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')
            ->name('logout');
