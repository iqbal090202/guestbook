<?php

use App\Http\Controllers\API\GuestsControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/guests', [GuestsControllerAPI::class, 'index']);
Route::get('/attendance/{id}', [GuestsControllerAPI::class, 'show']);
Route::post('/guests', [GuestsControllerAPI::class, 'store']);
// Route::put('/guests/{id}', [GuestsControllerAPI::class, 'update'])->name('guestapi.update');
// Route::delete('/guests{id}', [GuestsControllerAPI::class, 'destroy'])->name('guestapi.destroy');
