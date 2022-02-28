<?php

use App\Http\Controllers\AutomobileController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'service'], function () {
    Route::group(['prefix' => 'view'], function () {
        Route::get('deactivate-clients', [ClientController::class, 'deactivateClients']);
        Route::get('cars/{id}', [AutomobileController::class, 'getCarClient']);
        Route::get('active/{number}', [AutomobileController::class, 'activeStatus']);
        Route::get('deactivate/{number}', [AutomobileController::class, 'deActiveStatus']);
        Route::get('active-cars', [AutomobileController::class, 'getActiveCars']);
    });
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('auto', AutomobileController::class);
});


Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
