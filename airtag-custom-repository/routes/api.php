<?php

use App\Http\Controllers\AirtagController;
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

Route::group(['prefix' => 'airtags-info'], static function () {
    Route::get('/', [AirtagController::class, 'index']);
    Route::post('/', [AirtagController::class, 'store']);
});
