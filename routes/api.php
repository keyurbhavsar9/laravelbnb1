<?php

use App\Models\Bookable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookableController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/bookables', 'App\Http\Controllers\Api\BookableController@index');
// Route::get('/bookables/{id}', 'App\Http\Controllers\Api\BookableController@show');

Route::apiResource('bookables', 'App\Http\Controllers\Api\BookableController')->only(['index', 'show']);