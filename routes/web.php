<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index');
    Route::match(['get', 'post'], '/signup', 'signUp')->name('signup');
    Route::match(['get', 'post'], '/login', 'login')->name('login');
    
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::match(['get', 'post'], 'dashboard/create', 'create')->name('addExpense');
    });

    Route::match(['get', 'post'], '/logout', [AuthController::class,'logout'])->name('logout');
});
