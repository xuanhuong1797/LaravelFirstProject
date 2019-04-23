<?php

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

Route::prefix('location')->group(function () {
    Route::get('/district', 'LocationController@getDistrict');
    Route::get('/ward', 'LocationController@getWard');
});
