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

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:api');

// Route::group(['middleware' => 'auth:api'], function(){
  Route::group(['namespace' => 'Api'], function() {
    Route::group(['namespace' => 'User'], function() {

      // attendances
      Route::group(['prefix' => 'attendances'], function() {
        /**
         * /api/attendances
         */
        Route::get('/', 'AttendancesController@index');
        Route::get('/month/{year}/{month}', 'AttendancesController@month');
        Route::get('/day/{year}/{month}/{day}', 'AttendancesController@day');
      });
    });
  });
// });
