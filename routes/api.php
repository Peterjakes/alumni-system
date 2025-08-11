<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MPesaDonationController; 

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

// M-Pesa STK Push Callback URL
// This route should be publicly accessible as M-Pesa will hit it directly.
// It should NOT be behind 'auth:sanctum' middleware.
Route::post('/mpesa/callback', [MPesaDonationController::class, 'callback'])->name('mpesa.callback');
