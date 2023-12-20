<?php

use App\Http\Controllers\Dashboard\AdminProfileController;
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

Route::get('test', fn() => view('dashboard.profile.edit'));


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
//});

//require __DIR__.'/auth.php';
