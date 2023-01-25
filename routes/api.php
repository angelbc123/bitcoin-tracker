<?php

use App\Http\Controllers\Api\BitcoinStateController;
use App\Http\Controllers\Api\BitcoinSubscriberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('bitcoin-states', [BitcoinStateController::class, 'index'])
    ->name('bitcoin-states.index');

Route::post('bitcoin-subscribers', [BitcoinSubscriberController::class, 'store'])
    ->name('bitcoin-subscribers.store');
