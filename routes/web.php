<?php

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
/**
* top /
*/
Route::get('/', function () {
    return view('welcome');
});

// 認証周り
Auth::routes();

// user
Route::group(['middleware' => 'auth'], function(){
    Route::group(['namespace' => 'User'], function() {

        Route::get('/home', 'DashboardController@index');
        // dashboard
        Route::get('/dashboard', 'DashboardController@index');

        // attendances
        Route::group(['prefix' => 'attendances'], function() {
            Route::get('/', 'AttendancesController@index');
            Route::get('/month/{year}/{month}', 'AttendancesController@month');
            Route::get('/day/{year}/{month}/{day}', 'AttendancesController@day');
            Route::post('/create/day', 'AttendancesController@createDay');
            Route::post('/update/day/{uuid}', 'AttendancesController@updateDay');
            Route::get('/update/day/status/{uuid}', 'AttendancesController@updateDay');
            Route::get('/create/day/{status}/{year}/{month}/{day}', 'AttendancesController@createDayYmd');
            Route::post('/update/month_summary/status_close/{uuid}', 'AttendancesController@monthStatusClose');
        });

        // setting
        Route::group(['prefix' => 'setting'], function() {
            Route::get('/', 'SettingController@index');
            Route::get('/account', 'SettingController@account');
            // monthly_base_infos
            Route::get('/monthly_base_infos', 'SettingController@monthlyBaseInfos');
            Route::get('/monthly_base_infos/new', 'SettingController@monthlyBaseInfoEdit');
            Route::get('/monthly_base_infos/edit/{uuid}', 'SettingController@monthlyBaseInfoEdit');
            Route::post('/create/monthly_base_infos', 'SettingController@createMonthlyBaseInfos');
            Route::post('/update/monthly_base_infos/{uuid}', 'SettingController@updateMonthlyBaseInfos');
        });
    });
});
