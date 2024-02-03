<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GuestsController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/guests', [GuestsController::class, 'index'])->name('guest.index');
    Route::get('/guests/create', [GuestsController::class, 'create'])->name('guest.create');
    Route::post('/guests', [GuestsController::class, 'store'])->name('guest.store');
    Route::get('/guests/{id}', [GuestsController::class, 'edit'])->name('guest.edit');
    Route::put('/guests/{id}', [GuestsController::class, 'update'])->name('guest.update');
    Route::delete('/guests/{id}', [GuestsController::class, 'destroy'])->name('guest.destroy');

    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
});
