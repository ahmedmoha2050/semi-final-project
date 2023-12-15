<?php

use App\Http\Controllers\Dashboard\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {

    Route::prefix('dashboard')->as('dashboard.')->group(function () {

        Route::prefix('login')->middleware('guest:admin')->group(function () {
            Route::get('/', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
            Route::post('/', [AdminAuthenticatedSessionController::class, 'store'])->name('login');
        });


        Route::middleware('auth:admin')->group(function () {
            Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');

            Route::get('/', DashboardController::class)->name('index');
        });

    });

});


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

