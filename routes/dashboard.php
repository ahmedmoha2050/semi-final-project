<?php

use App\Http\Controllers\Dashboard\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Dashboard\Auth\AdminEmailVerificationNotificationController;
use App\Http\Controllers\Dashboard\Auth\AdminEmailVerificationPromptController;
use App\Http\Controllers\Dashboard\Auth\AdminNewPasswordController;
use App\Http\Controllers\Dashboard\Auth\AdminPasswordController;
use App\Http\Controllers\Dashboard\Auth\AdminPasswordResetLinkController;
use App\Http\Controllers\Dashboard\Auth\AdminVerifyEmailController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\AdminProfileController;
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

        Route::middleware(['guest:admin'])->group(function () {

            Route::prefix('login')->group(function () {
                Route::get('/', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
                Route::post('/', [AdminAuthenticatedSessionController::class, 'store'])->name('login');
            });

            /********************** Start Password Reset Routes **************************/

            Route::get('forgot-password', [AdminPasswordResetLinkController::class, 'create'])
                ->name('password.request');

            Route::post('forgot-password', [AdminPasswordResetLinkController::class, 'store'])
                ->name('password.email');

            Route::get('reset-password/{token}', [AdminNewPasswordController::class, 'create'])
                ->name('password.reset');

            Route::post('reset-password', [AdminNewPasswordController::class, 'store'])
                ->name('password.store');

            /********************** End Password Reset Routes **************************/
        });


        Route::middleware('auth:admin')->group(function () {

            /******************* Start Email Verification **************************/

            Route::get('verify-email', AdminEmailVerificationPromptController::class)
                ->name('verification.notice');

            Route::get('verify-email/{id}/{hash}', AdminVerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

            Route::post('email/verification-notification', [AdminEmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

            /******************* End Email Verification **************************/

            Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');

            Route::middleware(['verified:dashboard.verification.notice'])->group(function () {
                Route::get('/', DashboardController::class)->name('index');

                /************************ Start Profile Routes *****************************/
                Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
                Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
                Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
                /************************ End Profile Routes *****************************/

                Route::put('password', [AdminPasswordController::class, 'update'])->name('password.update');

            });
        });
    });
});

//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

