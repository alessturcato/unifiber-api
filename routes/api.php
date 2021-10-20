<?php

use App\Http\Controllers\CopertureUnifiberController;
use App\Http\Controllers\CopertureUnifiberTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

/**
 * Api per la gestione delle coperture UniFiber
 */
Route::group(['prefix'=> '/v1/coperture_unifiber', 'middleware' => 'auth.basic.once'], function() {
    Route::post('/registra', [CopertureUnifiberController::class, 'registra']);
    Route::get('/storico/{id}', [CopertureUnifiberController::class, 'storico']);
    Route::post('/ricerca', [CopertureUnifiberController::class, 'ricerca']);
});

Route::group(['prefix'=> '/v1/coperture_unifiber_test', 'middleware' => 'auth.basic.once'], function() {
    Route::post('/registra', [CopertureUnifiberTestController::class, 'registra']);
    Route::get('/storico/{id}', [CopertureUnifiberTestController::class, 'storico']);
    Route::post('/ricerca', [CopertureUnifiberTestController::class, 'ricerca']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
