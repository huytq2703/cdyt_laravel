<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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


Route::get('/test', [ApiController::class, 'test']);

Route::group([
    'prefix' => 'v1'
], function () {
    Route::prefix('locations')->group(function () {
        Route::get('provinces', [ApiController::class, 'getProvinces']);
        Route::get('districts/{province_id}', [ApiController::class, 'getDistricts']);
        Route::get('wards/{district_id}', [ApiController::class, 'getWards']);
    });
});
