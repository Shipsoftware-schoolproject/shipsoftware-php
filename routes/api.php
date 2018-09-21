<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Protected routes
 */
Route::middleware('auth:web')->group(function() {
    /**
     * Routes for ships
     */
    Route::group(['prefix' => '/ship'], function() {
        Route::get('/name/{name?}', 'APIController@get_ship_names');
        Route::get('/info/{id}', 'APIController@get_ship_info');
        Route::get('/loc/current/{id}', 'APIController@get_ship_cur_location');
        Route::get('/loc/history/{id}', 'APIController@get_ship_loc_history');
    });

    /**
     * Routes for users
     */
    Route::post('user', 'APIController@add_user');
});
