<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return Inertia::render('Auth/Login');
})->middleware('guest');

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');
Route::post('/user-destroy/{id}', [UserController::class, 'destroy'])->middleware(['auth', 'admin'])->name('user.destroy');

Route::get('/user-dashboard', [EmailController::class, 'index'])->middleware(['auth'])->name('userDashboard');


require __DIR__.'/auth.php';
