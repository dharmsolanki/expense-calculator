<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
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
        Route::get('dashboard/view-expense', 'view')->name('viewExpense');
        Route::match(['get', 'post'],'dashboard/edit-expense/{id}', 'edit')->name('editExpense');
    });

    Route::middleware(['auth', 'checkUserRole:1'])->controller(RolesController::class)->group(function () {
        Route::get('dashboard/add-role','index')->name('addRole');
        Route::match(['get', 'post'],'dashboard/create-role','create')->name('roles.create');
        Route::match(['get','post'], 'dashboard/edit-role/{id}','edit')->name('roles.edit');
        Route::delete('dashboard/delete-role/{id}','destroy')->name('roles.destroy');
    });

    Route::middleware(['auth', 'checkUserRole:1'])->controller(MenuController::class)->group(function () {
        Route::get('dashboard/add-menu','index')->name('addMenu');
        Route::match(['get', 'post'],'dashboard/create-menu','create')->name('menu.create');
        Route::match(['get', 'post'],'dashboard/edit-menu/{id}','edit')->name('menu.edit');
    });

    Route::middleware(['auth', 'checkUserRole:1'])->controller(UsersController::class)->group(function () {
        Route::get('dashboard/add-user','index')->name('addUser');
        Route::match(['get', 'post'],'dashboard/create-user','create')->name('user.create');
        Route::match(['get', 'post'],'dashboard/edit-user/{id}','edit')->name('user.edit');
        Route::delete('dashboard/delete-user/{id}','destroy')->name('user.destroy');
        Route::post('dashboard/user/restore-user/{id}','restore')->name('user.restore');
    });
    

    Route::match(['get','post'],'dashboard/change-password',[UsersController::class, 'changePassword'])->name("changePassword");
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
});
