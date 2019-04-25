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

Route::get('/datapoints/count', 'DataPointController@countItems');

Route::get('/crops/count', 'CropController@countItems');
Route::get('/crops/itemsCount', 'CropController@itemsCount');
Route::resource('/datapoints','DataPointController',['only'=>['index','show']]);
Route::resource('/crops','CropController',['only'=>['index','show']]);
