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
Route::get('/datapoints','DataPointController@api_list');
Route::get('/crops','CropController@api_list');
Route::get('/units', 'UnitController@api_list');

Route::get('/varieties', 'VarietyController@api_list');
